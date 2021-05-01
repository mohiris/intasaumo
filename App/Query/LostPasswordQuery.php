<?php
namespace App\Query;

use Core\Database\QueryBuilder;

class LostPasswordQuery
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
        $query = $this->builder->select("*")->from("password_reset")->where("id = $id");

        return $query->getResult();

    }

    /**
     * @param string $email
     */
    public function getByEmail(string $email)
    {
        $query = $this->builder->select("*")->from("password_reset")->where("email = $email");
        return $query->getQuery();
    }

    /**
     * @param string $email
     */
    public function getByToken(string $token)
    {
        $query = $this->builder->select("*")->from("password_reset")->where("token = $token");
        return $query->getQuery();
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $query = $this->builder->delete()->from("password_reset")->where("id = $id");
        return $query->getQuery();
    }

    /**
     * @param array $data
     */
    public function create(array $data)
    {
        $selector = bin2hex(random_bytes(8));
        $token = random_bytes(32);
        $hashedToken = password_hash($token, PASSWORD_DEFAULT);
        $expires = date("U") + 900;

        $values = array(
            "token" => $hashedToken,
            "selector" => $selector,
            "expires" => $expires,
        );
        $result = array_merge($data, $values);

        $query = $this->builder->insertInto("password_reset")->columns($result)->values($result)->save();
        return $query;
    }

    /**
     * @param array $data
     */
    public function update(array $data, int $id)
    {
        $query = $this->builder->update("password_reset")->set($data)->where("id = $id");
    }

    /**
     * @param string $roles
     */
    public function orderByEmail(string $email)
    {
        $query = $this->builder->select("*")->from("password_reset")->orderBy("email", "ASC");
        return $query->getQuery();
    }

    /**
     * @param int $created_at
     */
    public function orderByCreationDate(string $created_at)
    {
        $query = $this->builder->select("*")->from("password_reset")->orderBy("created_at", "ASC");
        return $query->getQuery();
    }

    /**
     * @param int $created_at
     */
    public function orderByUpdatedDate(string $updated_at)
    {
        $query = $this->builder->select("*")->from("password_reset")->orderBy("updated_at", "ASC");
        return $query->getQuery();
    }
}