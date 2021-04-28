<?php
namespace App\Form;
use Core\Facade\Form;

class UserRegisterForm 
{

    public function getForm()
    {

        $form = Form::create('/user/login')
                ->input('firstname', 'text', ['min' => 4, 'max' => 55, 'required' => 'required'])
                ->input('lastname', 'text')
                ->input('email', 'email')
                ->input('password', 'password')
                ->input('gender', 'radio', ['value' => 'homme', 'checked' => 'checked'])
                ->input('gender', 'radio', ['value' => 'femme'])
                ->input('fruit', 'checkbox', ['value' => 'pomme'])
                ->input('fruit', 'checkbox', ['value' => 'poire'])
                ->select('status', 'Je suis', ['required' => 'required', 'options' => ['étudiant', 'chômeur', 'professionel']])
                ->textarea('contact', 'laissez-nous un message')
                ->input('login', 'submit', ['value' => 'login']);
                
        return $form->getForm();
    }

   
}