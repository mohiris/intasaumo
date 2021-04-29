<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLostPasswordForm
{

    public function getForm()
    {
        $form = Form::create('/admin/login')
            ->input('email', 'email', ['value' => 'Email'])
            ->input('reset-request-submit', 'submit', ['value' => 'Réinitialiser le mot de passe']);
        return $form->getForm();
    }


}