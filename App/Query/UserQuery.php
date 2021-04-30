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
     * @param string $roles
     */
    public function getByRole(string $roles)
    {
        $query = $this->builder->select("*")->from("users")->where("roles = $roles");
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
     * @param string $firstname
     */
    public function getByFirstname(string $firstname)
    {
        $query = $this->builder->select("*")->from("users")->where("firstname = $firstname");
        return $query->getQuery();
    }

    /**
     * @param string $lastname
     */
    public function getByLastname(string $lastname)
    {
        $query = $this->builder->select("*")->from("users")->where("lastname = $lastname");
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

    /**
     * @param string $roles
     */
    public function orderByRoles(string $roles)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("roles", "ASC");
        return $query->getQuery();
    }

    /**
     * @param string $firstname
     */
    public function orderByFirstname(string $firstname)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("firstname", "ASC");
        return $query->getQuery();
    }

    /**
     * @param string $lastname
     */
    public function orderByLastname(string $lastname)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("lastname", "ASC");
        return $query->getQuery();
    }

    /**
     * @param int $created_at
     */
    public function orderByCreationDate(string $created_at)
    {
        $query = $this->builder->select("*")->from("users")->orderBy("created_at", "ASC");
        return $query->getQuery();
    }
}