<?php
$servername = "mysql";  // Имя сервера MySQL (контейнер)
$username = "root";     // Пользователь
$password = "root";     // Пароль
$dbname = "maindb";     // Имя базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
?>