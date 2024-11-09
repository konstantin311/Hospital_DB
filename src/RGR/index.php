<?php
$servername = "mysql";
$username = "root";
$password = "root";
$dbname = "maindb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$table = $_GET['table'] ?? 'patients';


echo "Hello world";
$conn->close();
?>