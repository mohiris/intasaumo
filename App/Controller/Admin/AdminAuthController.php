<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;
use App\Form\UserLoginForm;

class AdminAuthController extends Controller{

    private $request;

    private $response;

    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
    }

    public function index()
    {
        $form = new UserLoginForm();
        $userLogin = $form->getForm();
        $this->render("admin/user/login.phtml", ['userLogin'=>$userLogin]);
    }

    
    public function login()
    {
        if($this->request->isPost()){
            var_dump($this->request->getBody());
        }
    }

}