<?php
namespace App\Controller\Admin;

use App\Email\UserResetPasswordEmail;
use App\Form\UserLoginForm;
use App\Form\UserResetPasswordForm;
use App\Model\LostPasswordModel;
use App\Query\LostPasswordQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use App\Form\UserLostPasswordForm;
use Core\Http\Response;
use Core\Http\Session;
use Core\Util\Email;
use App\Query\UserQuery;
use Core\Util\Hash;
use Core\Util\TokenGenerator;


class AdminLostPassword extends Controller
{
    private $request;

    private $response;

    private $userLostPasswordForm;

    private $lostPasswordModel;

    private $validator;

    private $userQuery;

    private $lostPasswordQuery;

    private $session;

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
                    $expires = date("U") + 900;

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
        $form = new UserResetPasswordForm();
        $userResetPassword = $form->getForm();

        $this->render("admin/user/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);
    }

    public function resetPassword(){

        if($this->request->isPost()) {
            $data = $this->request->getBody();
            $errors = $this->validator->validate($this->userModel, $data);

            if (empty($errors)) {

                if ($this->userQuery->update($data)) {

                    $form = new UserLoginForm();
                    $userLogin = $form->getForm();

                    $this->render("admin/user/login.phtml", ['userLogin'=>$userLogin]);
                }

            }
        }
    }

}