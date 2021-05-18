<?php
namespace Core\Migration;
use Core\Database\DB;

class tags_table_migration
{
    public function up(){
        $conn = DB::getConnection();

        $sql = "CREATE TABLE IF NOT EXISTS menus
        (
            `id`  BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(55) NOT NULL,
            `description` TEXT NULL,
            `link` VARCHAR(255) NOT NULL,
            `pages_id` BIGINT NOT NULL,
            `pages_articles_id` BIGINT NOT NULL,
            `pages_articles_categories_id` BIGINT NOT NULL,
            `pages_articles_tags_id` BIGINT NOT NULL,
            INDEX `fk_menus_pages1_idx` (`pages_id` ASC, `pages_articles_id` ASC, `pages_articles_categories_id` ASC, `pages_articles_tags_id` ASC) VISIBLE,
            CONSTRAINT `fk_menus_pages1`
                FOREIGN KEY (`pages_id` , `pages_articles_id` , `pages_articles_categories_id` , `pages_articles_tags_id`)
                REFERENCES `goschool`.`pages` (`id` , `articles_id` , `articles_categories_id` , `articles_tags_id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION
        ) ENGINE=INNODB CHARSET=`utf8`;";
        $conn->exec($sql);
    }
}