<?php
namespace App\Form;
use Core\Facade\Form;

class UserRegisterForm 
{

    public function getForm()
    {

        $form = Form::create('/admin/register')
                ->input('firstname', 'text', ['value' => 'Prénom', 'min' => 4, 'max' => 55, 'required' => 'required'])
                ->input('lastname', 'text', ['value' => 'Nom'])
                ->input('email', 'email', ['Value' => 'Addresse E-mail'])
                ->input('password', 'password', ['Mot de passe'])
                ->input('passwordConfirm', 'password', ['value' => 'Confirmer mot de passe'])
                ->input('register', 'submit', ['value' => 'Inscription']);
                
        return $form->getForm();
    }

}