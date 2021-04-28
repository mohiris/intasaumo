<?php
namespace Core\Database;

abstract class Model {
    public const RULE_REQUIRED = 'required';

    private $rules;
    
    abstract function rules();

    public function save()
    {
        
    }

    public function validate()
    {
        
    }

    public function errorMessages()
    {
        return [

        ]
    }


}