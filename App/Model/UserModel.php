<?php
namespace App\Model;
use Core\Database\Model;
use Core\Database\Validator;

class UserModel extends Model
{
    private $firstname;

    private $lastname;

    private $username;

    private $email;

    private $password;

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function rules()
    {
        $validator = new Validator();

                
        $rules = [
            'firstname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'lastname' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'username' => ['type' => 'string',  'min' => 3, 'required' => 'required', 'max' => 25],
            'email' => ['type' => 'email',  'min' => 8, 'required' => 'required', 'max' => 25],
            'password' => ['type' => 'string',  'min' => 6, 'required' => 'required', 'max' => 25],
            'confirmPassword' => ['type' => 'string', 'min' => 6, 'required' => 'required', 'max' => 25, 'match' => 'password']
        ];
        $validator->setRules($this, $rules);

    }
}