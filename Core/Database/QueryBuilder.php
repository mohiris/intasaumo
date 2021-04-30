<?php
namespace Core\Database;

class QueryBuilder{

    private $fields;

    private $condition;

    private $from;

    private $query;

    public function select(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'SELECT ' . implode(', ', $this->fields);
        return $this;
    }

    public function update(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'UPDATE ' . implode(', ', $this->fields);
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'DELETE ' . implode(', ', $this->fields);
        return $this;
    }

    public function where(): QueryBuilder
    {
        foreach(\func_get_args() as $arg){
            $this->condition[] = $arg;
        }
        $this->query .= ' WHERE ' . implode(', AND', $this->condition) . ";";
        return $this;
    }

    public function from($table, $alias = null): QueryBuilder
    {
        if(is_null($alias)){
            $this->from[] = $table;
        }else{
            $this->from[] = "$table AS $alias";
        }
        $this->query .= ' FROM ' . implode(', ', $this->from);
        return $this;
    }

    public function join(): QueryBuilder
    {
        return $this;
    }

    protected function setSelect()
    {
    }

    /**
     * @return string $query
     */
    public function getQuery() : string
    {
        return $this->query;
    }

}