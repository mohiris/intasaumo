<?php
namespace Core\Database;
use Core\Database\DB;
class QueryBuilder{

    private $fields;

    private $condition;

    private $from;

    private $table;

    private $query;

    private $column;

    private $values;

    public function select(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'SELECT ' . implode(', ', $this->fields);
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

    public function getResult()
    {
        $db = new DB();

        try{
            $result = $this->query->fetch(PDO::FETCH_ASSOC);
            return $result;
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
    }


    public function update($table, $alias = null): QueryBuilder
    {
        if(is_null($alias)){
            $this->table = $table;
        }else{
            $this->table = "$table AS $alias";
        }
        $this->query .= ' UPDATE ' . $this->table;
        
        return $this;
    }

    public function set(array $data)
    {
        $this->fields = \func_get_args();
        $rowStr = "";
        foreach($data as $row => $value){
            if($row == 'id'){
                continue;
            }
            $rowStr .= $row . ' = ' . "'$value', ";
        }

        $this->query .= ' SET ' . $rowStr;
        return $this;
    }

    public function delete(): QueryBuilder
    {
        $this->fields = \func_get_args();
        $this->query .= 'DELETE ';
        return $this;
    }

    public function insertInto($tableName)
    {
        $this->table = $tableName;
        $this->query .= 'INSERT INTO ' . $this->table;
        return $this;
    }

    public function columns(array $columns)
    {
        $columnsStr = "";
        $last = array_pop($columns);

        foreach($columns as $col){
            $columnsStr .= $col .", ";
        }
        $columnsStr .= $last .") ";

        $columnsStr = " (" . $columnsStr;
        $this->query .= $columnsStr;
        return $this;
    }


    public function values(array $values)
    {
        $valuesStr = "";
        $last = array_pop($values);
        foreach($values as $value){
            $valuesStr .= "'$value', ";
        }
        $valuesStr .= "'$last');";


        $valuesStr = "VALUES (" . $valuesStr;
        $this->query .= $valuesStr;
        return $this;

    }

}