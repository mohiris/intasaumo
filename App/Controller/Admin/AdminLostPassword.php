<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use App\Form\UserLostPasswordForm;
use Core\Http\Response;


class AdminLostPassword extends Controller
{
    private $request;

    private $response;

    public function __construct(){
        $this->request = new Request();
        $this->response = new Response();
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
            var_dump($this->request->getBody());
        }
    }
}