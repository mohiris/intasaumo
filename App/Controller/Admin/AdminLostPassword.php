<?php
namespace App\Controller\Admin;

use App\Model\LostPasswordModel;
use App\Query\LostPasswordQuery;
use Core\Component\Validator;
use Core\Controller;
use Core\Http\Request;
use App\Form\UserLostPasswordForm;
use Core\Http\Response;
use Core\Util\Email;


class AdminLostPassword extends Controller
{
    private $request;

    private $response;

    private $userLostPasswordForm;

    private $lostPasswordModel;

    //private $validator;

    private $lostPasswordQuery;

    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
        $this->userLostPasswordForm = new UserLostPasswordForm();
        $this->lostPasswordModel = new LostPasswordModel();
        //$this->validator = new Validator();
        $this->lostPasswordQuery = new LostPasswordQuery();
    }

    public function indexLostPassword()
    {
        $form = new UserLostPasswordForm();
        $userLostPasswordForm = $form->getForm();

        $this->render("admin/user/lostpassword.phtml", ['userLostPassword'=>$userLostPasswordForm]);
    }

    public function lostPassword()
    {
        if($this->request->isPost()){
            $data = $this->request->getBody();
            //$result = $this->lostPasswordQuery->getByEmail($data['email']);

            $emailTo = $data['email'];

            if ($emailTo == 'antoinesaunier2@gmail.com'){

                $email = new Email();
                $email->send('contact.goschool@gmail.com', $emailTo, 'Réinitialisation de votre mot de passe goSchool', '<h1>Hello</h1>');

                $this->lostPasswordQuery->create($data);
                $form = new UserLostPasswordForm();
                $userLostPasswordForm = $form->getForm();

                $this->render("admin/user/lostPasswordRequestSuccess.phtml", ['userLostPassword'=>$userLostPasswordForm]);
            }

            else{
                $form = new UserLostPasswordForm();
                $userLostPasswordForm = $form->getForm();

                $this->render("admin/user/lostPasswordRequestFailure.phtml", ['userLostPassword'=>$userLostPasswordForm]);
            }
        }
    }
}