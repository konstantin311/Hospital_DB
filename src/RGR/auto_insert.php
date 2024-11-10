<?php
include 'functions.php';

function auto_insert_data($conn) {
    $data = [
        'Patients' => [
            ['name' => 'Иван Иванов', 'date_of_birth' => '1980-01-01', 'gender' => 'M', 'contact_number' => '1234567890'],
            ['name' => 'Мария Петрова', 'date_of_birth' => '1990-02-02', 'gender' => 'F', 'contact_number' => '0987654321'],
            ['name' => 'Петр Сидоров', 'date_of_birth' => '1975-03-03', 'gender' => 'M', 'contact_number' => '1122334455'],
            ['name' => 'Ольга Васильева', 'date_of_birth' => '1985-04-04', 'gender' => 'F', 'contact_number' => '5566778899'],
            ['name' => 'Дмитрий Николаев', 'date_of_birth' => '1995-05-05', 'gender' => 'M', 'contact_number' => '9988776655']
        ],
    ];

    foreach ($data as $table => $records) {
        foreach ($records as $record) {
            $columns = implode(', ', array_keys($record));
            $values = "'" . implode("', '", array_values($record)) . "'";
            $sql = "INSERT INTO $table ($columns) VALUES ($values)";
            if ($conn->query($sql) === FALSE) {
                echo "Ошибка: " . $conn->error;
            } else {
                echo "Запись добавлена в таблицу $table<br>";
            }
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
    <title>Автоматическое заполнение таблиц</title>
</head>
<body>
    <h1>Таблицы успешно заполнены!</h1>
    <form method="get" action="index.php">
        <button type="submit">Вернуться на главную</button>
    </form>
</body>
</html>