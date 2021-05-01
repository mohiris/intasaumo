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
use App\Query\UserQuery;

class AdminAuthController extends Controller{

    private $request;

    private $response;

    private $userRegisterForm;

    private $userModel;

    private $validator;

    private $userQuery;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->userRegisterForm = new UserRegisterForm();
        $this->userModel = new UserModel();
        $this->validator = new Validator();
        $this->userQuery = new UserQuery();
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
            $errors = $this->validator->validate($this->userModel, $data);

            if(empty($errors)){
                $this->userQuery->create($data);
            }else{
                
                $form = new UserRegisterForm();
                $userRegister = $form->getForm();
                
                $this->render('admin/user/register.phtml', ['errors' => $errors, 'userRegister'=>$userRegister]);
            }
        }
    }
}