<?php
namespace App\Controller\Admin;

use App\Email\UserResetPasswordEmail;
use App\Form\UserResetPasswordForm;
use App\Model\LostPasswordModel;
use App\Query\LostPasswordQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use App\Form\UserLostPasswordForm;
use Core\Http\Response;
use Core\Http\Session;
use App\Query\UserQuery;
use Core\Util\Hash;
use Core\Util\TokenGenerator;

class AdminLostPassword extends Controller
{
    private $request;

    private $lostPasswordModel;

    private $validator;

    private $userQuery;

    private $lostPasswordQuery;

    private $token;

    private $hashToken;

    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
        $this->userLostPasswordForm = new UserLostPasswordForm();
        $this->lostPasswordModel = new LostPasswordModel();
        $this->validator = new Validator();
        $this->userQuery = new userQuery();
        $this->lostPasswordQuery = new LostPasswordQuery();
        $this->session = new Session();
        $this->token = new TokenGenerator();
        $this->hashToken = new Hash();
    }

    public function indexLostPassword()
    {
        $form = new UserLostPasswordForm();
        $userLostPasswordForm = $form->getForm();

        $this->render("admin/user/lostpassword.phtml", ['userLostPassword'=>$userLostPasswordForm]);
    }

    public function lostPassword()
    {
        $data = $this->request->getBody();
        $errors = $this->validator->validate($this->lostPasswordModel, $data);
        $emailTo = $data['email'];

        if ($this->request->isPost()) {

            if(empty($errors)){

                if ($emailTo == implode('', $this->userQuery->getEmail($data['email']))) {

                    $token = $this->token->generateToken(32);
                    $hashedToken = $this->hashToken->passwordHash($token);
                    $selector = $this->token->bin2hex($this->token->generateToken(8));
                    $expires = date("U") + 1800;

                    $values = array(
                        "token" => $hashedToken,
                        "selector" => $selector,
                        "expires" => $expires,
                    );
                    $data = array_merge($data, $values);

                    if($this->lostPasswordQuery->create($data))
                    {
                        $url = "http://localhost:8080/admin/resetpassword?selector=".$selector."&validator=".$this->token->bin2hex($token);

                        $email = new UserResetPasswordEmail();
                        $userResetPasswordEmail = $email->sendEmail($emailTo, $url);

                        $form = new UserLostPasswordForm();
                        $userLostPasswordForm = $form->getForm();

                        $this->render("admin/user/lostPasswordRequestSuccess.phtml", ['userLostPassword' => $userLostPasswordForm]);
                    }
                }
            }
            else {
                $form = new UserLostPasswordForm();
                $userLostPasswordForm = $form->getForm();

                $this->render("admin/user/lostPasswordRequestFailure.phtml", ['userLostPassword' => $userLostPasswordForm]);
            }
        }
    }

    public function indexResetPassword(){

        if($this->request->isGet()){
            $data = $this->request->getBody();
            $selector = $data['selector'];
            $validator = $data['validator'];

            if (empty($selector) || empty($validator))
            {
                die('Impossible de valider votre requête');
            }
            else {
                if (ctype_xdigit($selector) !== false && ctype_xdigit($validator) != false)
                {
                    $form = new UserResetPasswordForm();
                    $userResetPassword = $form->getForm();
                    $this->render("admin/user/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);
                }
                else{
                    die('Impossible de valider votre requête');
                }
            }
        }
    }

    public function resetPassword(){

        if($this->request->isPost()) {

            $data = $this->request->getBody();
            $selector = $data['selector'];
            $validator = $data['validator'];
            $password = $data['password'];
            $passwordConfirm = $data['passwordConfirm'];

            if (empty($password) || empty($passwordConfirm))
            {

                $form = new UserResetPasswordForm();
                $userResetPassword = $form->getForm();
                $this->render("admin/user/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);

            }
            elseif ($password != $passwordConfirm)
            {
                $form = new UserResetPasswordForm();
                $userResetPassword = $form->getForm();
                $this->render("admin/user/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);
            }

            $currentDate = date('U');
            $result =$this->lostPasswordQuery->getBySelectorAndExpires($selector, $currentDate);

            if (!$this->lostPasswordQuery->getBySelectorAndExpires($selector, $currentDate)) {
                die('Cette demande de renouvellement de mot de passe a expiré.');
            }
            else {
                $tokenbin = $this->token->hex2bin($validator);
                $tokenCheck = $this->hashToken->compareHash($tokenbin, $result['token']);

                if ($tokenCheck === false)
                {
                    die('Il y a eu une erreur, vous devez refaire une demande de réinitialisation de mot de passe.');
                }
                elseif ($tokenCheck === true){

                    $tokenEmail = $result['email'];

                    if (!$this->userQuery->getByEmail($tokenEmail)){
                        die('Il y a eu une erreur, vous devez refaire une demande de réinitialisation de mot de passe.');
                    }
                    else{
                        $newPasswordHash = $this->hashToken->passwordHash($password);
                        $value = array(
                            "password_hash" => $newPasswordHash,
                        );

                        $userUpdateQuery = new UserQuery();

                        if (!$userUpdateQuery->updatePassword($value, $tokenEmail))
                        {
                            $this->request->redirect('/admin/lostpassword');
                        }
                        else{
                            $lostPasswordDelete = new LostPasswordQuery();

                            if (!$lostPasswordDelete->deleteByEmail($tokenEmail))
                            {
                                die('Il y a eu une erreur.');
                            }
                            else{
                                $this->request->redirect('/admin/login');
                            }
                        }
                    }
                }
            }
        }
    }

}