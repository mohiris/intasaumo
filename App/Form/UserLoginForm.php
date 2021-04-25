<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLoginForm
{

    public function getForm()
    {

        $form = Form::create('/user/login')
                ->input('Adresse e-mail:', 'email')
                ->input('Mot de passe:', 'password');
        return $form->getForm();
    }

   
}