<?php
include 'functions.php';
$tables = getTables($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Администрирование Больницы</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Администрирование Больницы</h1>

        <div class="section">
            <form method="get" action="index2.php">
                <button type="submit">Добавление записей в таблицу</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="view_table.php">
                <div class="form-group">
                    <label for="table_view">Выберите таблицу для просмотра:</label>
                    <select name="table" id="table_view">
                        <?php foreach ($tables as $table): ?>
                            <option value="<?= $table ?>"><?= $table ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit">Просмотр</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="auto_insert.php">
                <button type="submit">Автоматически заполнить таблицы</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="delete.php">
                <button type="submit">Удаление всех данных из таблицы</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="query1.php">
                <button type="submit">Врачи и пациенты с назначениями в текущем месяце</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="query2.php">
                <button type="submit">Отделения и количество врачей</button>
            </form>
        </div>

        <div class="section">
            <form method="get" action="query3.php">
                <div class="form-group">
                    <label for="patient_name">Введите имя пациента:</label>
                    <input type="text" name="patient_name" id="patient_name" required>
                </div>
                <button type="submit">Показать назначения пациента</button>
            </form>
        </div>
    </div>
</body>
</html>
