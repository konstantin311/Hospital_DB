<?php
include 'config.php';

// Функция для получения списка всех таблиц в базе данных
function getTables($conn) {
    $sql = "SHOW TABLES";
    $result = $conn->query($sql);
    $tables = [];
    while ($row = $result->fetch_row()) {
        $tables[] = $row[0];
    }
    return $tables;
}

// Функция для получения структуры таблицы (имена столбцов)
function getTableColumns($conn, $table) {
    $sql = "DESCRIBE $table";
    $result = $conn->query($sql);
    $columns = [];
    while ($row = $result->fetch_assoc()) {
        $columns[] = $row['Field'];
    }
    return $columns;
}

// Функция для получения содержимого таблицы
function getTableContent($conn, $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    return $rows;
}

// Функция для вставки данных в таблицу
function insertData($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";
    $sql = "INSERT INTO $table ($columns) VALUES ($values)";
    
    if ($conn->query($sql) === TRUE) {
        return "Запись успешно добавлена!";
    } else {
        return "Ошибка: " . $conn->error;
    }
}
?>
