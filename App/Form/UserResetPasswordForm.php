<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserResetPasswordForm
{

    public function getForm()
    {

        $form = Form::create('/admin/resetPassword')
                ->input('password', 'password', ['value' => 'Nouveau mot de passe'])
                ->input('password', 'password', ['value' => 'Confirmer le mot de passe'])
                ->input('submit', 'submit', ['value' => 'Changer']);
        return $form->getForm();
    }

   
}