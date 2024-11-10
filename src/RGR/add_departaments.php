<?php
include 'config.php';

// Проверка, если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $floor = $_POST['floor'] ?? '';

    // Массив ошибок
    $errors = [];

    // Проверка имени
    if (empty($name)) {
        $errors[] = "Поле 'Название отдела' обязательно для заполнения.";
    }

    // Проверка floor (должен быть от 1 до 10)
    if (empty($floor)) {
        $errors[] = "Поле 'Этаж' обязательно для заполнения.";
    } elseif ($floor < 1 || $floor > 10) {
        $errors[] = "Поле 'Этаж' должно быть в диапазоне от 1 до 10.";
    }

    // Если нет ошибок, выполняем вставку
    if (empty($errors)) {
        // Подготовка SQL-запроса для вставки
        $sql = "INSERT INTO Departments (name, floor) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Проверка на успешную подготовку запроса
        if ($stmt === false) {
            die('Ошибка при подготовке запроса: ' . $conn->error);
        }

        // Привязываем параметры (s - строка, i - целое число)
        $stmt->bind_param("si", $name, $floor);

        // Выполнение запроса
        if ($stmt->execute()) {
            echo "<p>Отдел успешно добавлен!</p>";
        } else {
            echo "<p style='color:red;'>Ошибка: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        // Вывод ошибок
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить отдел</title>
</head>
<body>
    <h1>Добавить новый отдел</h1>
    <form method="post">
        <label for="name">Название отдела:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="floor">Этаж:</label>
        <select id="floor" name="floor" required>
            <?php
            // Генерация вариантов этажей от 1 до 10
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Добавить</button>
    </form>
</body>
</html>
