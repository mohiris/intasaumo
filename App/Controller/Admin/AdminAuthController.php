<?php
namespace App\Controller\Admin;

use Core\Controller;
use Core\Http\Request;
use Core\Http\Response;

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
        $this->render("admin/user/login.phtml");
    }

    
    public function login()
    {
        if($this->request->isPost()){
            var_dump($this->request->getBody());
        }
    }

}