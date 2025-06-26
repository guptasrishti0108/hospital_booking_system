CREATE DATABASE IF NOT EXISTS `User`;
USE `User`;

CREATE TABLE `signin` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(60) COLLATE utf8mb4_general_ci NOT NULL,
    `password` VARCHAR(60) COLLATE utf8mb4_general_ci NOT NULL,
    `cpassword` VARCHAR(60) COLLATE utf8mb4_general_ci NOT NULL
);