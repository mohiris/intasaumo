<?php
namespace App\Controller;
use Core\Controller;
use App\Query\UserQuery;
use App\Form\UserRegisterForm;

class HomeController extends Controller{

    public function index(){

        $userform = new UserRegisterForm();
        $form = $userform->getForm();

        return $this->render('welcome.phtml', ['registerForm' => $form]);

    }
}