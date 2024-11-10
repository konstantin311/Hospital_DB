<?php
include 'config.php';
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $date_of_birth = $_POST['date_of_birth'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';

    // Проверка полей
    $errors = [];
    if (empty($name)) {
        $errors[] = "Поле 'Имя' обязательно для заполнения.";
    } else {
        // Проверка, что имя соответствует формату "Фамилия Имя Отчество" с заглавными буквами
        if (!preg_match('/^[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+$/u', $name)) {
            $errors[] = "Поле 'Имя' должно содержать Фамилию, Имя и Отчество, начинающиеся с заглавной буквы.";
        }
    }

    if (empty($date_of_birth)) $errors[] = "Поле 'Дата рождения' обязательно для заполнения.";
    if (empty($gender)) $errors[] = "Поле 'Пол' обязательно для выбора.";
    if (empty($contact_number)) {
        $errors[] = "Поле 'Номер телефона' обязательно для заполнения.";
    } else {
        // Проверка, что номер начинается с "89" и содержит 10 цифр
        if (!preg_match('/^89\d{8}$/', $contact_number)) {
            $errors[] = "Поле 'Номер телефона' должно начинаться с '89' и содержать ровно 10 цифр.";
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Patients (name, date_of_birth, gender, contact_number) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $date_of_birth, $gender, $contact_number);

        if ($stmt->execute()) {
            echo "<p>Пациент успешно добавлен!</p>";
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
    <title>Добавить пациента</title>
</head>
<body>
    <h1>Добавить нового пациента</h1>
    <form method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required
               pattern="[А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+ [А-ЯЁ][а-яё]+"
               title="ФИО должно содержать три слова с заглавной буквы (Фамилия Имя Отчество)"><br><br>

        <label for="date_of_birth">Дата рождения:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br><br>

        <label for="gender">Пол:</label>
        <select id="gender" name="gender" required>
            <option value="">Выберите пол</option>
            <option value="M">Мужской</option>
            <option value="F">Женский</option>
        </select><br><br>

        <label for="contact_number">Номер телефона:</label>
        <input type="text" id="contact_number" name="contact_number" required
               pattern="89\d{8}" title="Номер должен начинаться с 89 и содержать 10 цифр"><br><br>

        <button type="submit">Добавить</button>
    </form>
</body>
</html>
