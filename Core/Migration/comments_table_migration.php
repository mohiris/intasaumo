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
            `users_id` BIGINT(20) NOT NULL,
            `comment_parent` BIGINT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX `fk_comments_users_idx` (`users_id` ASC),
            CONSTRAINT `fk_comments_users`
                FOREIGN KEY (`users_id`)
                REFERENCES `users` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}