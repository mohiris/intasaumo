<?php
namespace App\Query;

use Core\Database\QueryBuilder;
use Core\Util\Hash;

class UserQuery
{
    private $builder;

    public function __construct()
    {
        $this->builder = new QueryBuilder();

    }

    /**
     * @param int $id
     * @return string $query
     */
    public function getById(int $id)
    {
        $query = $this->builder->select("*")->from("users")->where("id = $id");
    
        return $query->getResult();
    
    }

    /**
     * @param string $email
     */
    public function getByEmail(string $email)
    {

    }
    
    /**
     * @param string $username
     */
    public function getByUsername(string $username)
    {

    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("users")->where("id = $id");
        return $query->getQuery();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        
        $hash = new Hash();
        
        if(array_key_exists('password', $data) && array_key_exists('passwordConfirm', $data)){

            $data['password_hash'] = $hash->passwordHash($data['password']);

            unset($data["password"]); 
            unset($data["passwordConfirm"]);

            $query = $this->builder->insertInto("users")->columns($data)->values($data)->save();
            return $query;
        }
        

    }

    /**
     * @param array $data
     */
    public function update(array $data, int $id)
    {
        $query = $this->builder->update("users")->set($data)->where("id = $id");
        return $query->getQuery();
    }
}