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
            `title` VARCHAR(255) NOT NULL,
            `slug` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `tags_id` BIGINT NOT NULL,
            `categories_id` BIGINT NOT NULL,
            `image` VARCHAR(255) NULL,
            `status` VARCHAR(55) NOT NULL DEFAULT 'unpublished',
            `active_comment` TINYINT NULL DEFAULT 0,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX `fk_articles_categories1_idx` (`categories_id` ASC) VISIBLE,
            INDEX `fk_articles_tags1_idx` (`tags_id` ASC) VISIBLE,
            CONSTRAINT `fk_articles_categories1`
                FOREIGN KEY (`categories_id`)
                REFERENCES `goschool`.`categories` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION,
            CONSTRAINT `fk_articles_tags1`
                FOREIGN KEY (`tags_id`)
                REFERENCES `goschool`.`tags` (`id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE=INNODB CHARSET=`utf8`;";

        $conn->exec($sql);
    }
}