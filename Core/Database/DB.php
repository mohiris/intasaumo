<?php
namespace Core\Database;

class DB extends \PDO
{

  private $instance = null;

  public function __construct($config)
  {
        $conn = $config['db_driver'].":host=".$config['db_host'].";dbname=".$config['db_name'];

        $options = array(
          \PDO::ATTR_PERSISTENT => true,
          \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
        );

        try{
          $this->instance = new \PDO($conn, $config['db_username'], $config['db_password'], $options);

        }catch(\PDOException $e){
          echo $e->getMessage();
        }

  }

  public function getConnection()
  {  
    if(is_null($this->instance)){
      $this->instance = new DB();
    }
    return $this->instance;
  }

}
