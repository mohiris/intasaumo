<?php
namespace App\Form;
use Core\Util\Form;

class UserForm extends Form
{
    public function build()
    {
        $fields = [
            [
               'field' => 'input',
               'type' => 'text',
               'id' => 'username',
               'required' => 'required',
               'minLength' => 3,
               'maxLength' => 12,
               'placeholder' => 'enter username',
               'name' => 'username',
               'class' => 'form-input',
               'label' => ['for' => 'username', 'text' => 'Your username']
           ],
   
           [
               'field' => 'input',
               'type' => 'email',
               'id' => 'email',
               'required' => 'required',
               'minLength' => 7,
               'maxLength' => 12,
               'placeholder' => 'exemple@email.com',
               'name' => 'email',
               'class' => 'form-input',
               'label' => ['for' => 'email', 'text' => 'Your email address']
               
           ],
   
           [
               'field' => 'input',
               'type' => 'password',
               'minLength' => 6,
               'maxLength' => 12,
               'required' => 'required',
               'name' => 'password',
               'id' => 'password',
               'class' => 'form-input',
               'label' => ['for' => 'password', 'text' => 'Your password']
           ],
   
           [
               'field' => 'input',
               'type' => 'radio',
               'required' => 'required',
               'name' => 'gender',
               'value' => 'homme',
               'class' => 'form-input',
               'label' => ['for' => 'gender', 'text' => 'Home']
           ],
           
           [
               'field' => 'input',
               'type' => 'radio',
               'required' => 'required',
               'name' => 'gender',
               'value' => 'femme',
               'class' => 'form-input',
               'label' => ['for' => 'gender', 'text' => 'Femme']
           ],
           
           [
               'field' => 'input',
               'type' => 'checkbox',
               'required' => 'required',
               'id' => 'neswletter',
               'name' => 'password',
               'class' => 'form-input',
               'label' => ['for' => 'newsletter', 'text' => 'M\'abonner au newsletter']
           ],
           
           [
               'field' => 'select',
               'id' => 'fruits',
               'name' => 'fruits',
               'label' => ['for' => 'fruits', 'text' => 'Quel est votre fruit préféré ?'],
               'options' => [
                   ['value' => 'pomme', 'selected' => 'selected', 'text' => 'Pomme'],
                   ['value' => 'cerise', 'text' => 'Cerise'],
                   ['value' => 'poire', 'text' => 'Poire']
               ]
               ],
   
           [
               'field' => 'textarea',
               'id' => 'description',
               'name' => 'description',
               'rows' => 4,
               'cols' => 50,
               'class' => 'form-textarea',
               'label' => ['for' => 'description', 'text' => 'Décrivez-vous en quelque ligne']
           ],
           [
               'field' => 'input',
               'type' => 'submit',
               'class' => 'form-input',
               'value' => 'Envoyer'
           ],
       ];
   
       $builder->add($fields);
   
    }
}