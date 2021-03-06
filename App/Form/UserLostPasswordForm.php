<?php
namespace App\Form;
use Core\Interfaces\FormInterface;
use Core\Facade\Form;


class UserLostPasswordForm
{

    public function getForm()
    {
        $form = Form::create('/admin/lostpassword')
            ->input('reset-password-request-email', 'email', ['value' => 'Email'])
            ->input('reset-password-request-submit', 'submit', ['value' => 'RĂ©initialiser le mot de passe']);
        return $form->getForm();
    }


}