<?php
include 'config.php';

$sql = "SELECT Doctors.name AS doctor_name, Patients.name AS patient_name
        FROM Appointments
        JOIN Doctors ON Appointments.doctor_id = Doctors.doctor_id
        JOIN Patients ON Appointments.patient_id = Patients.patient_id
        WHERE MONTH(Appointments.appointment_date) = MONTH(CURRENT_DATE())
          AND YEAR(Appointments.appointment_date) = YEAR(CURRENT_DATE())";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Врач: " . $row['doctor_name'] . " - Пациент: " . $row['patient_name'] . "<br>";
    }
} else {
    echo "Назначений за текущий месяц не найдено.";
}

$conn->close();
?>
