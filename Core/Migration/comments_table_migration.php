<?php
namespace Core\Migration;
use Core\Database\DB;

class comments_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS comments
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `content` TEXT NULL,
            `users_id` INT NOT NULL,
            `comment_parent` BIGINT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`, `users_id`),
            INDEX `fk_comments_users_idx` (`users_id` ASC) VISIBLE,
            CONSTRAINT `fk_comments_users`
                FOREIGN KEY (`users_id`)
                REFERENCES `goschool`.`users` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}