<?php
namespace Core\Migration;
use Core\Database\DB;

class articles_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS articles
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(55) NOT NULL,
            `slug` VARCHAR(55),
            `content` TEXT NOT NULL,
            `tag` VARCHAR(25) NOT NULL,
            `image` VARCHAR(255),
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        
        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}