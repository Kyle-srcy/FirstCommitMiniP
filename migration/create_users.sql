-- SQL to create `mini_project` database and `users` table for the login system
-- Run this in phpMyAdmin or the MySQL shell (via XAMPP)

CREATE DATABASE IF NOT EXISTS `mini_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mini_project`;

CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(80) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_hash` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Example: create an admin user. Generate a password hash in PHP first.
-- From command line (or a very small PHP file) run:
-- php -r "echo password_hash('yourPasswordHere', PASSWORD_DEFAULT) . PHP_EOL;"
-- Then copy the generated hash into the VALUES below.

-- INSERT INTO `users` (username, email, password_hash) VALUES
-- ('admin', 'admin@example.com', '$2y$10$...replace_with_hash...');
