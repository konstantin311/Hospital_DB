<?php
$servername = "mysql";  // Имя сервера MySQL (контейнер)
$username = "root";     // Пользователь
$password = "root";     // Пароль
$dbname = "maindb";     // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>