<?php
namespace Core\Component;
use Core\Interfaces\FormFieldInterface;

class InputField{

    public function getField($name, $type, $params)
    {
        [
            'required' => true,
            'minLength' => '3',
            'maxLength' => '26',
            'placeholder' => 'hello',
            'value' => 'hey'
        ];

        $placeholder = $params['placeholder'] ?? $name;
        $value = $params['value'] ?? '';
        $min = $params['min'] ?? 3;
        $max = $params['max'] ?? 25;
        $required = $params['required'] ?? 'false';

        return sprintf(
            "<div class=\"input-group\">
                <label for=%s>%s</label>
                <input type=%s name=%s id=%s placeholder=%s minlength=%s maxlength=%s required=%s />
            </div>
            ",
            $name,
            ucfirst($name),
            $type,
            $name,
            $name,
            $placeholder,
            $min,
            $max,
            $required
        );
    }


}