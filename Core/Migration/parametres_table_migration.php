<?php
namespace Core\Migration;
use Core\Database\DB;

class parametres_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS parametres
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `site_title` VARCHAR(55) NOT NULL,
            `slug` VARCHAR(55) NOT NULL,
            `description` TEXT NOT NULL,
            `url` VARCHAR(55) NOT NULL,
            `visibility` BOOLEAN,
            `default_role` BOOLEAN,
            `save_status` BOOLEAN,
            `update_status` BOOLEAN,
            `role_name` VARCHAR(55) NOT NULL,
            `logo` VARCHAR(255),
            `lang` VARCHAR(55) NOT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        
        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}