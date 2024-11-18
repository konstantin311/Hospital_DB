<?php
include 'config.php';

// Получение списка отделений из базы данных
$sql_departments = "SELECT department_id, name FROM Departments";
$result_departments = $conn->query($sql_departments);
$departments = [];

if ($result_departments->num_rows > 0) {
    while ($row = $result_departments->fetch_assoc()) {
        $departments[] = $row;
    }
}

// Проверка, если форма отправлена
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $specialization = $_POST['specialization'] ?? '';
    $department_id = $_POST['department_id'] ?? '';

    // Массив ошибок
    $errors = [];

    // Проверка имени (ФИО с заглавной буквы и с использованием регулярного выражения)
    if (empty($name)) {
        $errors[] = "Поле 'Имя' обязательно для заполнения.";
    } else {
        // Проверка, что имя соответствует формату "Фамилия Имя Отчество" с заглавными буквами
        if (!preg_match('/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+$/u', $name)) {
            $errors[] = "Поле 'Имя' должно содержать Фамилию, Имя и Отчество, начинающиеся с заглавной буквы.";
        }
    }

    // Проверка специализации
    if (empty($specialization)) { 
        $errors[] = "Поле 'Специальность' обязательно для заполнения.";
    } else {
        // Проверяем, что специальность начинается с заглавной буквы
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $specialization)) {
            $errors[] = "Поле 'Специальность' должно начинаться с заглавной буквы и содержать только буквы.";
        }
    }

    // Проверка выбранного отделения
    if (empty($department_id)) {
        $errors[] = "Поле 'Отделение' обязательно для выбора.";
    }

    // Если нет ошибок, выполняем вставку
    if (empty($errors)) {
        // Подготовка SQL-запроса для вставки
        $sql = "INSERT INTO Doctors (name, specialization, department_id) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Проверка на успешную подготовку запроса
        if ($stmt === false) {
            die('Ошибка при подготовке запроса: ' . $conn->error);
        }

        // Привязываем параметры (s - строка, i - целое число)
        $stmt->bind_param("ssi", $name, $specialization, $department_id);

        // Выполнение запроса
        if ($stmt->execute()) {
            echo "<p>Доктор успешно добавлен!</p>";
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
    <title>Добавить врача</title>
</head>
<body>
    <h1>Добавить нового врача</h1>
    <form method="post">
        <label for="name">ФИО:</label>
        <input type="text" id="name" name="name" required
               pattern="[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+"
               title="ФИО должно содержать три слова с заглавной буквы (Фамилия Имя Отчество)"><br><br>

        <label for="specialization">Специальность:</label>
        <input type="text" id="specialization" name="specialization" required
               pattern="[А-ЯЁ][а-яё]+"
               title="Поле 'Специальность' должно начинаться с заглавной буквы и содержать только буквы."><br><br>

        <label for="department_id">Отделение:</label>
        <select id="department_id" name="department_id" required>
            <option value="">Выберите отделение</option>
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['department_id'] ?>"><?= $department['name'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Добавить</button>
    </form>
</body>
</html>
