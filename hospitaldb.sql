CREATE DATABASE HospitalDB;
USE HospitalDB;

CREATE TABLE hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    latitude DECIMAL(10, 6) NOT NULL,
    longitude DECIMAL(10, 6) NOT NULL,
    speciality ENUM('Head', 'Eye', 'Neck', 'Chest', 'Abdomen', 'Arm', 'Leg', 'Back') NOT NULL
);

CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(225) NOT NULL,
    hospital_name VARCHAR(255) NOT NULL,
    injury_type VARCHAR(100) NOT NULL,
    booking_time DATETIME NOT NULL
);

INSERT INTO hospitals (name, latitude, longitude, speciality) VALUES
('Pune General Hospital', 18.5204, 73.8567, 'Head'),
('Ruby Hall Clinic', 18.5349, 73.8799, 'Eye'),
('Jehangir Hospital', 18.5289, 73.8745, 'Neck'),
('Sahyadri Hospital', 18.5093, 73.8296, 'Chest'),
('Deenanath Mangeshkar Hospital', 18.5074, 73.8301, 'Abdomen'),
('Noble Hospital', 18.5016, 73.8582, 'Arm'),
('Aditya Birla Memorial Hospital', 18.6382, 73.7769, 'Leg'),
('Columbia Asia Hospital', 18.5201, 73.8530, 'full body'),
('Poona Hospital', 18.5113, 73.8477, 'Head'),
('Command Hospital', 18.5679, 73.8896, 'Eye'),
('Rising Medicare Hospital', 18.6031, 73.7512, 'Leg'),
('KEM Hospital', 18.5196, 73.8546, 'full body'),
('Medipoint Hospital', 18.5627, 73.9276, 'Neck'),
('Lifepoint Multispeciality Hospital', 18.6030, 73.7615, 'Chest'),
('Ratna Memorial Hospital', 18.5234, 73.8509, 'Abdomen'),
('Sparsh Hospital', 18.5167, 73.8632, 'Arm'),
('Ace Hospital', 18.4957, 73.8443, 'Leg'),
('Chaitanya Hospital', 18.5300, 73.8750, 'full body'),
('Apollo Clinic', 18.5309, 73.8575, 'Head'),
('ONP General Hospital', 18.5261, 73.8791, 'Eye'),
('Global Hospital', 18.5832, 73.7413, 'Neck'),
('Joshi Hospital', 18.5082, 73.8500, 'Chest'),
('Kotbagi Hospital', 18.5694, 73.8233, 'Abdomen'),
('Surya Hospital', 18.5520, 73.8071, 'Arm'),
('Manik Hospital', 18.6015, 73.7411, 'Leg'),
('Shashwat Hospital', 18.5099, 73.8442, 'full body'),
('Niramaya Hospital', 18.5764, 73.8085, 'Head'),
('Galaxy Care Hospital', 18.5101, 73.8362, 'Eye'),
('Baner Multispeciality Hospital', 18.5635, 73.7791, 'Neck'),
('Shree Hospital', 18.5243, 73.8457, 'Chest'),
('Nisarg Hospital', 18.5090, 73.8226, 'Abdomen'),
('Unique Hospital', 18.5148, 73.8904, 'Arm'),
('Anjali Hospital', 18.5771, 73.8503, 'Leg'),
('Lokmanya Hospital', 18.6232, 73.8072, 'Back'),
('Unity Hospital', 18.5183, 73.8426, 'Head'),
('Yash Hospital', 18.5678, 73.8784, 'Eye'),
('Galaxy Multispeciality Hospital', 18.6011, 73.7415, 'Neck'),
('Sai Seva Hospital', 18.5325, 73.8302, 'Chest'),
('Sanjeevani Hospital', 18.5291, 73.8478, 'Abdomen'),
('Samarth Hospital', 18.5723, 73.8911, 'Arm'),
('Apex Hospital', 18.6063, 73.7628, 'Leg'),
('Omkar Hospital', 18.5199, 73.8399, 'full body'),
('Shatayu Hospital', 18.5117, 73.8184, 'Head'),
('Balaji Hospital', 18.5333, 73.8511, 'Eye'),
('Krishna Hospital', 18.5712, 73.8235, 'Neck'),
('Sai Kripa Hospital', 18.5978, 73.7412, 'Chest'),
('Trinity Hospital', 18.5264, 73.8195, 'Abdomen'),
('Morya Hospital', 18.5403, 73.8790, 'Arm'),
('Suryoday Hospital', 18.5607, 73.8991, 'Leg'),
('Infinity Hospital', 18.5231, 73.8823, 'full body');

