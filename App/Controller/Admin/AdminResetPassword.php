<?php
namespace App\Controller\Admin;

use Core\Controller;
use App\Form\UserLostPasswordForm;
use Core\Http\Request;

class AdminResetPassword extends Controller
{
    private $request;

    public function __construct(){
        $this->request = new Request();
    }

    public function indexLostPassword()
    {
        $form = new UserLostPasswordForm();
        $userLostPassword = $form->getForm();
        $this->render("admin/user/lostpassword.phtml", ['userLostPassword'=>$userLostPassword]);
    }

    public function lostPastword(){

        if ($this->request->isPost()){
            var_dump($this->request->getBody());
            $selector = bin2hex(random_bytes(8));
            $token = random_bytes(32);

            $url = "http://localhost:8080/";

        }else{

        }

    }
}