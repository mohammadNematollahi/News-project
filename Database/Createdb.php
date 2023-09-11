<?php

namespace Database\createdb;

use Database\database\Database;

class Createdb extends Database
{
    private $createTableQueries = array(

        "CREATE TABLE `users`(
            `id` INT NOT NULL AUTO_INCREMENT,
            `first_name` VARCHAR(150) NOT NULL,
            `last_name` VARCHAR(200) NOT NULL,
            `email` VARCHAR(200) NOT NULL,
            `password` VARCHAR(200) NOT NULL,
            `permission` enum('user','admin') NOT NULL DEFAULT 'user',
            `varify_token` VARCHAR(255),
            `is_active` TINYINT DEFAULT(0),
            `forget_token` VARCHAR(255),
            `forget_token_expire` VARCHAR(255),
            `created_at` DATETIME NOT NULL DEFAULT(now()),
            `updated_at` DATETIME,
            primary key(`id`),
            UNIQUE (`email`)
            );
            ",
        "CREATE TABLE `categories`(
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(150) NOT NULL ,
                `created_at` DATETIME NOT NULL DEFAULT(now()),
                `updated_at` DATETIME,
                PRIMARY KEY(`id`)
                );
                ",
        "CREATE TABLE `posts`(
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `title` VARCHAR(255) NOT NULL,
                        `summary` TEXT NOT NULL,
                        `body` TEXT NOT NULL,
                        `view` INT NOT NULL DEFAULT(0),
                        `id_user` INT NOT NULL,
                        `id_cat` INT  NOT NULL,
                        `image` TEXT NOT NULL,
                        `status` TINYINT NOT NULL DEFAULT(0),
                        `published_at` DATETIME NOT NULL,
                        `selected` TINYINT NOT NULL DEFAULT(0),
                        `breaking_news` TINYINT NOT NULL DEFAULT(0),
                        `created_at` DATETIME NOT NULL DEFAULT(now()),
                        `updated_at` DATETIME,
                        PRIMARY KEY(`id`),
                        FOREIGN KEY (`id_cat`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                        FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                      );
                    ",
        "CREATE TABLE `baners`(
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `img` TEXT NOT NULL,
                        `url` VARCHAR(255) NOT NULL,
                        `created_at` DATETIME NOT NULL DEFAULT(now()),
                        `updated_at` DATETIME,
                        PRIMARY KEY(`id`)
                        );
                        ",
        "CREATE TABLE `comments`(
                        `id` INT NOT NULL AUTO_INCREMENT,
                        `user_id` INT NOT NULL,
                        `comment` TEXT NOT NULL,
                        `post_id` INT NOT NULL,
                        `status` enum('unseen','seen','approved') NOT NULL DEFAULT 'unseen',
                        `created_at` DATETIME NOT NULL DEFAULT(now()),
                        `updated_at` DATETIME,
                        PRIMARY KEY (`id`),
                        FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
                        FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                        );",
        "CREATE TABLE `menus`(
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `name` VARCHAR(150) NOT NULL,
                            `url` VARCHAR(255) NOT NULL,
                            `parent_id` INT NULL,
                            `created_at` DATETIME NOT NULL DEFAUlt(now()),
                            `updated_at` DATETIME,
                            PRIMARY KEY (`id`),
                            FOREIGN KEY (`parent_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
                            );",
        "CREATE TABLE `websetting`(
                            `id` INT NOT NULL AUTO_INCREMENT,
                            `title` VARCHAR(250),
                            `description` TEXT,
                            `keywords` VARCHAR(255),
                            `logo` TEXT ,
                            `icon` TEXT ,
                            `created_at` DATETIME NOT NULL DEFAULT(now()),
                            `updated_at` DATETIME,
                            PRIMARY KEY (`id`)
                            );"
    );

    private $squelInitials =
    array(
        array(
            "table" => "categories", "filds" => array("name"), "values" => array("news")
        )
    );

    public function run()
    {
        foreach ($this->createTableQueries as $createTableQuery) {
            $this->createTable($createTableQuery);
        }
        foreach ($this->squelInitials as $squelInitial) {
            $this->Insert($squelInitial["table"], $squelInitial["filds"], $squelInitial["values"]);
        }
    }
}
