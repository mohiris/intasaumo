<?php
namespace Core\Migration;
use Core\Database\DB;

class tags_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS pages
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `url` VARCHAR(255) NOT NULL,
            `image` VARCHAR(255) NULL,
            `content` TEXT NULL,
            `articles_id` BIGINT(20) NOT NULL,
            `articles_categories_id` BIGINT(20) NOT NULL,
            `articles_tags_id` BIGINT(20) NOT NULL,
            `categorie_parent` BIGINT NULL,
            `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            INDEX `fk_pages_articles1_idx` (`articles_id` ASC, `articles_categories_id` ASC, `articles_tags_id` ASC),
            CONSTRAINT `fk_pages_articles1`
                FOREIGN KEY (`articles_id` , `articles_categories_id` , `articles_tags_id`)
                REFERENCES `articles` (`id` , `categories_id` , `tags_id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}