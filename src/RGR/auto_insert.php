<?php
include 'functions.php';

function auto_insert_data($conn) {
    // Данные для каждой таблицы
    $patients = [
        ['name' => 'Иванов Иван Иванович', 'date_of_birth' => '1980-01-01', 'gender' => 'M', 'contact_number' => '8912345678'],
        ['name' => 'Петрова Мария Николоевна', 'date_of_birth' => '1990-02-02', 'gender' => 'F', 'contact_number' => '8999887766'],
        ['name' => 'Сидоров Петр Петрович', 'date_of_birth' => '1975-03-03', 'gender' => 'M', 'contact_number' => '8911223344'],
        ['name' => 'Васильева Ольга Ивановна', 'date_of_birth' => '1985-04-04', 'gender' => 'F', 'contact_number' => '8955500011'],
        ['name' => 'Николаев Дмитрий Николаевич', 'date_of_birth' => '1995-05-05', 'gender' => 'M', 'contact_number' => ' 8900112233']
    ];

    $doctors = [
        ['name' => 'Смирнов Иван Петрович', 'specialization' => 'Кардиолог', 'department_id' => 1],
        ['name' => 'Иванова Лидия Петровна', 'specialization' => 'Хирург', 'department_id' => 2],
        ['name' => 'Петров Петр Петрович', 'specialization' => 'Терапевт', 'department_id' => 3],
        ['name' =>'Сидорова Дарья Дмитриевна', 'specialization' => 'Офтальмолог', 'department_id' => 4],
        ['name' =>'Васильев Василий Васильевич', 'specialization' => 'Педиатр', 'department_id' => 5]
    ];

    $departments = [
        ['name' => 'Кардиология', 'floor' => 1],
        ['name' => 'Хирургия', 'floor' => 2],
        ['name' => 'Терапия', 'floor' => 3],
        ['name' => 'Неврология', 'floor' => 4],
        ['name' => 'Офтальмология', 'floor' => 5]
    ];

    $appointments = [
        ['patient_id' => 1, 'doctor_id' => 1, 'appointment_date' => '2024-11-10 09:00:00', 'diagnosis' => 'Гипертония'],
        ['patient_id' => 2, 'doctor_id' => 2, 'appointment_date' => '2024-11-10 10:00:00', 'diagnosis' => 'Острый аппендицит'],
        ['patient_id' => 3, 'doctor_id' => 3, 'appointment_date' => '2024-11-10 11:00:00', 'diagnosis' => 'ОРВИ'],
        ['patient_id' => 4, 'doctor_id' => 4, 'appointment_date' => '2024-11-10 12:00:00', 'diagnosis' => 'Мигрень'],
        ['patient_id' => 5, 'doctor_id' => 5, 'appointment_date' => '2024-11-10 13:00:00', 'diagnosis' => 'Дальнозоркость']
    ];

    // Вставляем данные в таблицу Departments
foreach ($departments as $record) {
    $columns = implode(', ', array_keys($record));
    $values = "'" . implode("', '", array_values($record)) . "'";
    $sql = "INSERT INTO Departments ($columns) VALUES ($values)";
    if ($conn->query($sql) === FALSE) {
        echo "Ошибка: " . $conn->error;
    } else {
        echo "Запись добавлена в таблицу Departments<br>";
    }
}

// Вставляем данные в таблицу Doctors (после того, как Departments уже заполнены)
foreach ($doctors as $record) {
    $columns = implode(', ', array_keys($record));
    $values = "'" . implode("', '", array_values($record)) . "'";
    $sql = "INSERT INTO Doctors ($columns) VALUES ($values)";
    if ($conn->query($sql) === FALSE) {
        echo "Ошибка: " . $conn->error;
    } else {
        echo "Запись добавлена в таблицу Doctors<br>";
    }
}

// Вставляем данные в таблицу Patients (после того, как Doctors и Departments уже заполнены)
foreach ($patients as $record) {
    $columns = implode(', ', array_keys($record));
    $values = "'" . implode("', '", array_values($record)) . "'";
    $sql = "INSERT INTO Patients ($columns) VALUES ($values)";
    if ($conn->query($sql) === FALSE) {
        echo "Ошибка: " . $conn->error;
    } else {
        echo "Запись добавлена в таблицу Patients<br>";
    }
}

// Вставляем данные в таблицу Appointments (после того, как Patients и Doctors уже заполнены)
foreach ($appointments as $record) {
    $columns = implode(', ', array_keys($record));
    $values = "'" . implode("', '", array_values($record)) . "'";
    $sql = "INSERT INTO Appointments ($columns) VALUES ($values)";
    if ($conn->query($sql) === FALSE) {
        echo "Ошибка: " . $conn->error;
    } else {
        echo "Запись добавлена в таблицу Appointments<br>";
    }
}
}

auto_insert_data($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Автоматическое заполнение таблиц</title>
</head>
<body>
<div class="container">
    <h1>Таблицы успешно заполнены!</h1>
    <form method="get" action="index.php">
        <button type="submit">Вернуться на главную</button>
    </form>
</div>
</body>
</html>
