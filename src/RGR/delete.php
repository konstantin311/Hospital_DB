<?php
include 'functions.php';

// Получаем список всех таблиц
$tables = getTables($conn);

// Проверяем, была ли выбрана таблица для удаления данных
if (isset($_GET['table'])) {
    $table = $_GET['table'];
    
    // SQL запрос для удаления всех данных из таблицы
    $sql = "DELETE FROM $table";
    
    if ($conn->query($sql) === TRUE) {
        echo "Все данные из таблицы '$table' были успешно удалены.";
    } else {
        echo "Ошибка: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Удалить все данные из таблицы</title>
</head>
<body>
    <h1>Удалить все данные из таблицы</h1>
    
    <!-- Форма для выбора таблицы -->
    <form method="get" action="delete.php">
        <label for="table">Выберите таблицу:</label>
        <select name="table" id="table" required>
            <?php foreach ($tables as $table): ?>
                <option value="<?= $table ?>"><?= $table ?></option>
            <?php endforeach; ?>
        </select><br><br>
        
        <button type="submit">Удалить все данные</button>
    </form>
    <br>
    
    <!-- Кнопка для перехода на главный экран -->
    <form method="get" action="index.php">
        <button type="submit">На главный экран</button>
    </form>
</body>
</html>
