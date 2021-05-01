<?php
namespace App\Controller\Admin;

use App\Query\UserQuery;
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
        $userquery = new UserQuery();
        $data = $this->request->getBody();
        $result = $userquery->getByEmail($data['reset-password-request-email']);
        $form = new UserLostPasswordForm();
        $userLostPasswordForm = $form->getForm();

        if($this->request->isPost()){

            if ($data['reset-password-request-email'] == 'test@gmail.com'){
                //echo $data['reset-password-request-email'];
                $this->render("admin/user/lostPasswordRequestSuccess.phtml", ['userLostPassword'=>$userLostPasswordForm]);
            }

            else{
                $this->render("admin/user/lostPasswordRequestFailure.phtml", ['userLostPassword'=>$userLostPasswordForm]);
            }
        }
    }
}