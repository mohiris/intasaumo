<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Form\UserLoginForm;
use App\Form\UserRegisterForm;
use App\Model\UserModel;
use App\Form\UserResetPasswordForm;
use Core\Component\Validator;

class AdminAuthController extends Controller{

    private $request;

    private $response;

    private $validator;

    private $userModel;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->validator = new Validator();
        $this->userModel = new UserModel();
    }

    public function indexLogin()
    {
        $form = new UserLoginForm();
        $userLogin = $form->getForm();

        $this->render("admin/user/login.phtml", ['userLogin'=>$userLogin]);
    }

    public function indexRegister()
    {

        $form = new UserRegisterForm();
        $userRegister = $form->getForm();

        $this->render("admin/user/register.phtml", ['userRegister'=>$userRegister]);
    }
    
    public function login()
    {
        if($this->request->isPost()){
            var_dump($this->request->getBody());
        }
    }

    public function register()
    {
        if($this->request->isPost()){
            $data = $this->request->getBody();
            var_dump($data);
            /*
            $data = $this->request->getBody();

            $userModel = new UserModel();
            $validator = new Validator();

            $manager = new Manager();
    
            if($validator->validate($userModel, $data)){
                $userModel->save($data);
            }
            */
    }


    }

}