<?php
namespace Core\Migration;
use Core\Database\DB;

class tags_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS categories
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(55) NOT NULL,
            `description` TEXT NULL,
            `image` VARCHAR(255) NULL,
            `categorie_parent` BIGINT NULL
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}