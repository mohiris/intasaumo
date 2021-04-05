<?php
namespace Core\ORM;

class FormType{

    public function inputType(array $params)
    {
        return [
            'field' => 'input',
            'type' => $params['type']??'text',
            'id' => $params['id'],
            'required' => $params['required']??false,
            'minLength' => $params['min']??3,
            'maxLength' => $params['max']??26,
            'placeholder' => $params['placeholder']??'',
            'name' => $params['name'],
            'class' => $params['class'] ?? '',
            'label' => ['for' => $params['for']??'', 'text' => $params['text']?? '']
        ];
    }


    public function selectType(array $params)
    {
 
        return [
            'field' => 'select',
            'id' => 'fruits',
            'name' => 'fruits',
            'label' => ['for' => 'fruits', 'text' => 'Quel est votre fruit préféré ?'],
            'options' => $this->getOptions($params)
            ];
    }

    public function textAreaType()
    {
       return  [
            'field' => 'textarea',
            'id' => 'description',
            'name' => 'description',
            'rows' => 4,
            'cols' => 50,
            'class' => 'form-textarea',
            'label' => ['for' => 'description', 'text' => 'Décrivez-vous en quelque ligne']
       ];
    }

    protected function getOptions(array $options)
    {
        $optionArray = [];

        foreach($options as $option){
            $optionArray[] = ['value' => $option['value'], 'selected' => $option['selected']??'', 'text' => $option['text']];
        }

        return $optionArray;
    }
}