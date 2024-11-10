<?php
include 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS Patients (
    patient_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('M', 'F') NOT NULL,
    contact_number VARCHAR(15) UNIQUE
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблица 'Patients' создана или уже существует.<br>";
} else {
    echo "Ошибка создания таблицы 'Patients': " . $conn->error . "<br>";
}

// Создаем таблицу Departments, если она не существует
$sql = "CREATE TABLE IF NOT EXISTS Departments (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL UNIQUE,
    floor INT NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблица 'Departments' создана или уже существует.<br>";
} else {
    echo "Ошибка создания таблицы 'Departments': " . $conn->error . "<br>";
}

// Создаем таблицу Doctors, если она не существует
$sql = "CREATE TABLE IF NOT EXISTS Doctors (
    doctor_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(50) NOT NULL,
    department_id INT,
    FOREIGN KEY (department_id) REFERENCES Departments(department_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблица 'Doctors' создана или уже существует.<br>";
} else {
    echo "Ошибка создания таблицы 'Doctors': " . $conn->error . "<br>";
}

// Создаем таблицу Appointments, если она не существует
$sql = "CREATE TABLE IF NOT EXISTS Appointments (
    appointment_id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATETIME NOT NULL,
    diagnosis VARCHAR(255),
    FOREIGN KEY (patient_id) REFERENCES Patients(patient_id),
    FOREIGN KEY (doctor_id) REFERENCES Doctors(doctor_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Таблица 'Appointments' создана или уже существует.<br>";
} else {
    echo "Ошибка создания таблицы 'Appointments': " . $conn->error . "<br>";
}

// Закрываем подключение
$conn->close();
?>
