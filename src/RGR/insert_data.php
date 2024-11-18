<?php
include 'functions.php';

// Получаем имя выбранной таблицы
$table = $_GET['table'];

// Получаем структуру таблицы (имена столбцов)
$columns = getTableColumns($conn, $table);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Сбор данных из формы
    $data = [];
    foreach ($columns as $column) {
        $data[$column] = $_POST[$column];
    }

    // Вставка данных в таблицу
    $message = insertData($conn, $table, $data);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Вставка данных в <?= $table ?></title>
</head>
<body>
    <div class="container">
    <h1>Добавление записи в таблицу: <?= $table ?></h1>

    <?php if (isset($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <?php foreach ($columns as $column): ?>
            <label for="<?= $column ?>"><?= $column ?>:</label>
            <input type="text" name="<?= $column ?>" id="<?= $column ?>" required><br><br>
        <?php endforeach; ?>
        <button type="submit">Добавить запись</button>
    </form>
    </div>
</body>
</html>
