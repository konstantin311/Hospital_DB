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

    <form method="get" action="add_patients.php">
        <button type="submit">Добавить нового пациента</button>
    </form>
    <br>

    <form method="get" action="add_departaments.php">
        <button type="submit">Добавить новое отделение</button>
    </form>
    <br>
    
    <!-- Форма для выбора таблицы для вставки данных -->
    <!--<form method="get" action="insert_data.php">
        <label for="table">Таблица:</label>
        <select name="table" id="table">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>"><?= $table ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Выбрать</button>
    </form>
    <br> -->
    
    <!-- Форма для просмотра таблицы -->
    <form method="get" action="view_table.php">
        <label for="table_view">Таблица для просмотра:</label>
        <select name="table" id="table_view">
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>"><?= $table ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Просмотр</button>
    </form>
    <br>

    <!-- Кнопка для автоматического заполнения таблиц -->
    <form method="get" action="auto_insert.php">
        <button type="submit">Автоматически заполнить таблицы</button>
    </form>
    <br>

    <!-- Форма для перехода на страницу удаления данных -->
    <form method="get" action="delete.php">
        <button type="submit">Удаление всех данных из таблицы</button>
    </form>
    <br>

    <!-- Кнопка для первого запроса -->
    <form method="get" action="query1.php">
        <button type="submit">Врачи и пациенты с назначениями в текущем месяце</button>
    </form>
    <br>

    <!-- Кнопка для второго запроса -->
    <form method="get" action="query2.php">
        <button type="submit">Отделения и количество врачей</button>
    </form>
    <br>

    <!-- Форма для третьего запроса с пользовательским вводом -->
    <form method="get" action="query3.php">
        <label for="patient_name">Введите имя пациента:</label>
        <input type="text" name="patient_name" id="patient_name" required>
        <button type="submit">Показать назначения пациента</button>
    </form>
    <br>

</body>
</html>
