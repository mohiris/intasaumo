<?php
namespace Core\Database;
use Core\Database\DB;
abstract class Model {
    public const RULE_REQUIRED = 'required';

    private $rules;
    
    abstract function rules();

    public function save($data)
    {
        $db = DB::getConnection();
    }

    public function validate($data)
    {
        foreach($data as $key => $value){
            if(\property_exists($this, $key)){
                $model->{$key} = $value;
            }
        }
    }

    public function errorMessages()
    {

    }


}