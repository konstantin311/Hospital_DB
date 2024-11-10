<?php
include 'config.php';

$sql = "SELECT Departments.name AS department_name, COUNT(Doctors.doctor_id) AS doctor_count
        FROM Departments
        LEFT JOIN Doctors ON Departments.department_id = Doctors.department_id
        GROUP BY Departments.name";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Отделение: " . $row['department_name'] . " - Количество врачей: " . $row['doctor_count'] . "<br>";
    }
} else {
    echo "Отделения и врачи не найдены.";
}

$conn->close();
?>