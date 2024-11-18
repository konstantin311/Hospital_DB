<?php
include 'functions.php';

$tables = getTables($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор таблицы для добавления новой записи</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
    <h1>Выберите таблицу для работы</h1>

    <form method="get" action="add_patients.php">
        <button type="submit">Добавить нового пациента</button>
    </form>
    <br>

    <form method="get" action="add_departaments.php">
        <button type="submit">Добавить новое отделение</button>
    </form>
    <br>

    <form method="get" action="add_doctors.php">
        <button type="submit">Добавить нового врача</button>
    </form>
    <br>

    <form method="get" action="add_appoitments.php">
        <button type="submit">Добавить прием пациента</button>
    </form>
    <br>
    
    <form method="get" action="index.php">
        <button type="submit">Вернуться на главную страницу</button>
    </form>
    <br>  
    </div>

</body>
</html>
