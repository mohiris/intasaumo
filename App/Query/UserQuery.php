<?php
namespace App\Query;

use Core\Database\QueryBuilder;

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
        return $query->getQuery();
    
    }

    /**
     * @param string $email
     */
    public function getByEmail(string $email)
    {
        $query = $this->builder->select("*")->from("users")->where("email = $email");
        return $query->getQuery();
    }
    
    /**
     * @param string $username
     */
    public function getByUsername(string $username)
    {
        $query = $this->builder->select("*")->from("users")->where("username = $username");
        return $query->getQuery();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("users")->where("id = $id");
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $query = $this->builder->insert($data)->into("users")->where("id = $id");
    }

    /**
     * @param array $data
     */
    public function updateUser(array $data)
    {
        $query = $this->builder->update()->set("data = $data")->where("id = $id");
    }
}