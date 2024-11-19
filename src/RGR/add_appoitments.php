<?php
include 'config.php';

$sql_patients = "SELECT patient_id, name FROM Patients";
$result_patients = $conn->query($sql_patients);
$patients = [];

if ($result_patients->num_rows > 0) {
    while ($row = $result_patients->fetch_assoc()) {
        $patients[] = $row;
    }
}

$sql_doctors = "SELECT doctor_id, name FROM Doctors";
$result_doctors = $conn->query($sql_doctors);
$doctors = [];

if ($result_doctors->num_rows > 0) {
    while ($row = $result_doctors->fetch_assoc()) {
        $doctors[] = $row;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_id = $_POST['patient_id'] ?? '';
    $doctor_id = $_POST['doctor_id'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $diagnosis = $_POST['diagnosis'] ?? '';

    $errors = [];

    if (empty($patient_id)) {
        $errors[] = "Поле 'Пациент' обязательно для выбора.";
    }

    if (empty($doctor_id)) {
        $errors[] = "Поле 'Доктор' обязательно для выбора.";
    }

    if (empty($appointment_date)) {
        $errors[] = "Поле 'Дата и время' обязательно для заполнения.";
    } elseif (!strtotime($appointment_date)) {
        $errors[] = "Некорректный формат даты и времени.";
    }

    if (empty($diagnosis)) {
        $errors[] = "Поле 'Диагноз' обязательно для заполнения.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Appointments (patient_id, doctor_id, appointment_date, diagnosis) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die('Ошибка при подготовке запроса: ' . $conn->error);
        }

        $stmt->bind_param("iiss", $patient_id, $doctor_id, $appointment_date, $diagnosis);

        if ($stmt->execute()) {
            echo "<p>Запись успешно добавлена!</p>";
        } else {
            echo "<p style='color:red;'>Ошибка: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Добавить прием</title>
</head>
<body>
    <div class=conteiner>
    <h1>Добавить новый прием</h1>
    <form method="post">
        <label for="patient_id">Пациент:</label>
        <select id="patient_id" name="patient_id" required>
            <option value="">Выберите пациента</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['patient_id'] ?>"><?= $patient['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="doctor_id">Доктор:</label>
        <select id="doctor_id" name="doctor_id" required>
            <option value="">Выберите доктора</option>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor['doctor_id'] ?>"><?= $doctor['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="appointment_date">Дата и время приема:</label>
        <input type="datetime-local" id="appointment_date" name="appointment_date" required><br><br>

        <label for="diagnosis">Диагноз:</label>
        <textarea id="diagnosis" name="diagnosis" required></textarea><br><br>

        <button type="submit">Добавить</button>
    </form>
    </div>
</body>
</html>
