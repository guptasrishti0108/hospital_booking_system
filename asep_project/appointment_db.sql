CREATE DATABASE appointment_db;
USE appointment_db;

CREATE TABLE hospitals (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    speciality VARCHAR(255) NOT NULL,
    hospital_id INT,
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
);

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    patient_name VARCHAR(255) NOT NULL,
    doctor_id INT,
    hospital_id INT,
    appointment_date DATE NOT NULL,
    slot VARCHAR(50) NOT NULL,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id),
    FOREIGN KEY (hospital_id) REFERENCES hospitals(id)
);

-- Insert sample data
INSERT INTO hospitals (name) VALUES ('City Hospital'), ('General Hospital');

INSERT INTO doctors (name, speciality, hospital_id) VALUES 
('Dr. Smith', 'Cardiologist', 1),
('Dr. Brown', 'Neurologist', 1),
('Dr. Lee', 'Orthopedic', 2),
('Dr. Taylor', 'Pediatrician', 2);