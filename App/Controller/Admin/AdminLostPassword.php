<?php
namespace App\Controller\Admin;

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

                    $url = "http://localhost:8080/admin/resetpassword?selector=".$selector."&validator=".bin2hex($token);
                    $message ='<div class="content email-userRegister">';
                    $message.='<p>Nous avons reçu une demande de réinitialisation de votre mot de passe GoSchool.</p>';
                    $message.='<p>Veuillez cliquer sur le lien ci-dessous pour réinitialiser votre mot de passe.</p>';
                    $message.='<p>Si la demande ne vient pas de vous, veuillez ignorer cet email.</p>';
                    $message.='<p>Voici votre lien de réinitialisation du mot de passe : <br>';
                    $message.='<a href="'.$url.'">'.$url.'</a></p>';
                    $message.='</div>';

                    $email = new Email();
                    $email->send('contact.goschool@gmail.com', $emailTo, 'Réinitialisation de votre mot de passe goSchool', $message);

                    $values = array(
                        "token" => $this->hashToken->passwordHash($this->token->generateToken(32)),
                        "selector" => $this->token->bin2hex($this->token->generateToken(8)),
                        "expires" => date("U") + 900,
                    );
                    $data = array_merge($data, $values);

                    $this->lostPasswordQuery->create($data);
                    $form = new UserLostPasswordForm();
                    $userLostPasswordForm = $form->getForm();

                    $this->render("admin/user/lostPasswordRequestSuccess.phtml", ['userLostPassword' => $userLostPasswordForm]);
                }
            }
            else {
                $form = new UserLostPasswordForm();
                $userLostPasswordForm = $form->getForm();

                $this->render("admin/user/lostPasswordRequestFailure.phtml", ['userLostPassword' => $userLostPasswordForm]);
            }
        }
    }

    public function resetPassword(){
        $form = new UserResetPasswordForm();
        $userResetPassword = $form->getForm();

        $this->render("admin/user/resetpassword.phtml", ['userResetPassword' => $userResetPassword]);
    }
}