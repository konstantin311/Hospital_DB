<?php
include 'config.php';

$patient_name = trim($_GET['patient_name'] ?? '');

// Проверка, что пользователь ввел имя пациента
if (empty($patient_name)) {
    echo "Введите имя пациента.";
} else {
    $stmt = $conn->prepare("SELECT Patients.name AS patient_name, Doctors.name AS doctor_name, 
                                   Appointments.appointment_date, Appointments.diagnosis
                            FROM Appointments
                            JOIN Patients ON Appointments.patient_id = Patients.patient_id
                            JOIN Doctors ON Appointments.doctor_id = Doctors.doctor_id
                            WHERE Patients.name = ?");
    $stmt->bind_param("s", $patient_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Пациент: " . $row['patient_name'] . ", Врач: " . $row['doctor_name'] . 
                 ", Дата назначения: " . $row['appointment_date'] . 
                 ", Диагноз: " . $row['diagnosis'] . "<br>";
        }
    } else {
        echo "Назначения для пациента с именем '$patient_name' не найдены.";
    }

    $stmt->close();
}

$conn->close();
?>