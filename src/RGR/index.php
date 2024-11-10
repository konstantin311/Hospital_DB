<?php
include 'functions.php';

$tables = getTables($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор таблицы</title>
</head>
<body>
    <h1>Выберите таблицу для работы</h1>
    <form method="get" action="insert_data.php">
        <label for="table">Таблица:</label>
        <select name="table" id="table">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>"><?= $table ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Выбрать</button>
    </form>
    <br>
    <form method="get" action="view_table.php">
        <label for="table_view">Таблица для просмотра:</label>
        <select name="table" id="table_view">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>"><?= $table ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Просмотр</button>
    </form>
</body>
</html>
