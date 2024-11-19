<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $floor = $_POST['floor'] ?? '';

    $errors = [];

    if (empty($name)) {
        $errors[] = "Поле 'Название отделения' обязательно для заполнения.";
    } else {
    if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $name)) {
        $errors[] = "Поле 'Название отделения' должно начинаться с заглавной буквы и содержать только буквы.";
        }
    }   

    if (empty($floor)) {
        $errors[] = "Поле 'Этаж' обязательно для заполнения.";
    } elseif ($floor < 1 || $floor > 10) {
        $errors[] = "Поле 'Этаж' должно быть в диапазоне от 1 до 10.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Departments (name, floor) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die('Ошибка при подготовке запроса: ' . $conn->error);
        }

        $stmt->bind_param("si", $name, $floor);

        if ($stmt->execute()) {
            echo "<p>Отдел успешно добавлен!</p>";
        } else {
            echo "<p style='color:red;'>Ошибка: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
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
    <link rel="stylesheet" href="style.css">
    <title>Добавить отделение</title>
</head>
<body>
    <div class=conteiner>
    <h1>Добавить новое отделение</h1>
    <form method="post">
        <label for="name">Название отделения:</label>
        <input type="text" id="name" name="name" required
            pattern="[А-ЯЁ][а-яё]+"
            title="Поле 'Название отделения' должно начинаться с заглавной буквы и содержать только буквы."><br><br>

        <label for="floor">Этаж:</label>
        <select id="floor" name="floor" required>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select><br><br>

        <button type="submit">Добавить</button>
    </form>
    </div>
</body>
</html>
