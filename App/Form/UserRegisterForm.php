<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserRegisterForm
{

    public function getForm()
    {

        $form = Form::create('/user/register')
                ->input('firstname', 'text' , ['min' => 10])
                ->input('lastname', 'text')
                ->input('email', 'email')
                ->input('password', 'password')
                ->input('gender', 'radio', ['value' => 'homme'])
                ->input('gender', 'radio', ['value' => 'femme']);
                
        return $form->getForm();
    }

   
}