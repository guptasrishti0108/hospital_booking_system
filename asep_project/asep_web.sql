CREATE DATABASE IF NOT EXISTS asep_web;
USE asep_web;

CREATE TABLE `profile` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    profile_image LONGBLOB,
    name TEXT COLLATE utf8mb4_general_ci NOT NULL,
    age INT(255) NOT NULL,
    height INT(255) NOT NULL,
    weight INT(255) NOT NULL,
    medical_history TEXT COLLATE utf8mb4_general_ci NOT NULL,
    blood_group TEXT COLLATE utf8mb4_general_ci NOT NULL,
    gender TEXT COLLATE utf8mb4_general_ci NOT NULL
);