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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        select, input[type="text"], button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #5a67d8;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }
        button:hover {
            background-color: #434190;
        }
        .section {
            padding: 15px 0;
            border-top: 1px solid #ddd;
        }
        .section:first-child {
            border-top: none;
        }
    </style>
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
