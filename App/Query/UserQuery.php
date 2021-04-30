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
        $query = $this->builder->delete()->from("users")->where("id = $id");
        return $query->getQuery();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $columns = array_keys($data);
        $values = array_values($data);

        $query = $this->builder->insertInto("users")->columns($columns)->values($values);
        return $query->getQuery();
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