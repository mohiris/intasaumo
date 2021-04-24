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

    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {

    }

    /**
     * @param array $data
     */
    public function update(array $data)
    {

    }
}