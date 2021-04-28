<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLoginForm
{

    public function getForm()
    {

        $form = Form::create('/admin/login')
                ->input('Adresse e-mail:', 'email')
                ->input('password', 'password', ['value' => 'Mot de passe'])
                ->input('valider', 'submit', ['value' => 'Login']);
        return $form->getForm();
    }

   
}