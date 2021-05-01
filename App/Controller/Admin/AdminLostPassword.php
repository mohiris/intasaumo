<?php
namespace App\Controller\Admin;

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

    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
        $this->userLostPasswordForm = new UserLostPasswordForm();
        $this->lostPasswordModel = new LostPasswordModel();
        $this->validator = new Validator();
        $this->userQuery = new userQuery();
        $this->lostPasswordQuery = new LostPasswordQuery();
        $this->session = new Session();
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

                    $email = new Email();
                    $email->send('contact.goschool@gmail.com', $emailTo, 'Réinitialisation de votre mot de passe goSchool', '<h1>Hello</h1>');

                    $selector = bin2hex(random_bytes(8));
                    $token = random_bytes(32);
                    $hashedToken = password_hash($token, PASSWORD_DEFAULT);
                    $expires = date("U") + 900;

                    $values = array(
                        "token" => $hashedToken,
                        "selector" => $selector,
                        "expires" => $expires,
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
}