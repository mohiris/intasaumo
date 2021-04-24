<?php
namespace Core\Database;

abstract class Model {
    public const RULE_REQUIRED = 'required';
    
    abstract function rules();

    public function save()
    {
        
    }


}