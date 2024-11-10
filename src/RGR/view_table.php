<?php
include 'functions.php';

// Получаем имя выбранной таблицы
$table = $_GET['table'];

// Получаем содержимое таблицы
$rows = getTableContent($conn, $table);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Просмотр данных из <?= $table ?></title>
</head>
<body>
    <h1>Содержимое таблицы: <?= $table ?></h1>

    <?php if (empty($rows)): ?>
        <p>Таблица пуста.</p>
    <?php else: ?>
        <table border="1">
            <thead>
                <tr>
                    <?php foreach ($rows[0] as $column => $value): ?>
                        <th><?= $column ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?= $value ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
