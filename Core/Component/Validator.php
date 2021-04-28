<?php
namespace Core\Component;
use Core\Database\Model;

class Validator
{
    private $errors = [];

    public function setRules(Model $model, array $rules){
        if($model instanceof Model && !empty($rules)){
            foreach($rules as $propertyName => $rusleArray){
                $propertyValue = $model->{$propertyName};

                foreach($rulesArray as $ruleName => $ruleValue){
                    if($ruleName == 'type' && $ruleValue == 'string'){
                        $this->validateString($propertyName, $propertyValue);
                    }

                    if($ruleName == 'type' && $ruleValue == 'email'){
                        $this->validateEmail($propertyName, $propertyValue);
                    }

                    if($ruleName == 'min'){
                        $this->validateMin($propertyName, $propertyValue);
                    }

                    if($ruleName == 'max'){
                        $this->validateMax($propertyName, $propertyValue);
                    }

                    if($ruleName == 'match'){
                        $this->validateMacth($propertyName, $propertyValue);
                    }
                }
            }
        }
    }

    public function validate($model, $data)
    {
        foreach($data as $key => $value){
            if(\property_exists($model, $key)){
                $model->{$key} = $value;
            }
        }


        return true;
    }

    public function validateString($propertyName, $value)
    {
        if(is_string($value)){
            return true;
        }

        $this->errors[$propertyName] = "Invalid $propertyName : must be a string";
        return false;
    }

    public function validateEmail($propertyName, $value)
    {
        if(filter_var($value, FILTER_VALIDATE_EMAIL)){
            return true;
        }

        $this->errors[$propertyName] = "Invalid $propertyName : must be a valid email address";
        return false;
    }

    public function validateRequered($value)
    {
        if(!empty($value)){
            return true;
        }

        $this->errors[$propertyName] = "Invalid $propertyName : is required";
        return false;
    }

    public function validateMin($propertyName, $value)
    {
        if(\strlen($value) >= $value){
            return true;
        }
        $this->errors[$propertyName] = "Invalid $propertyName : minimum length is $value";
        return false;
    }

    public function validateMax($propertyName, $value)
    {
        if(\strlen($value) > $value){
            return true;
        }
        $this->errors[$propertyName] = "Invalid $propertyName : maximum length is $value";
        return false;
    }

    public function validatePassword($propertyName, $value)
    {
        if($value){
            return true;
        }
        $this->errors[$propertyName] = "Invalid $propertyName : must contains letters and number";
        return false;
    }

    public function hasError($name)
    {
        if($this->$errors){

            return $this->errors[$name];
        }

        return null;
    }
}