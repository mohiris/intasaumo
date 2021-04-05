<?php
namespace App\Controller;
use Core\Controller;

class HomeController extends Controller{

    public function index(){
        $name = "Christian Mohindo";
        $age = 25;
        return $this->render('welcome.phtml', ['name' => $name, 'age' => $age]);
        //echo "<h1>HomeController index()";
    }
}