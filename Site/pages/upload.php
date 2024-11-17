<?php
$uploadDir = '../images/';
$dsn = 'mysql:host=localhost;dbname=pictures;charset=utf8';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$pdo = new PDO($dsn, $username, $password, $options);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image']))
{
    $fileName = $_FILES['image']['name'];
    $fileTmp = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmp, $filePath))
    {
        $stmt = $pdo->prepare("INSERT INTO Pictures (name, size, imagepath) VALUES (?, ?, ?)");
        $stmt->execute([$fileName, $fileSize, $filePath]);
        echo "Файл успішно завантажено!";
    }
    else
    {
        echo "Помилка завантаження.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Завантаження зображення</title>
    <link rel="stylesheet" href="../pages/styles.css">
</head>
<body>
<div class="container">
    <h1>Завантажити зображення</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" required>
        <button type="submit">Завантажити</button>
    </form>
    <br>
    <a href="../index.php"><button class="home">На головну</button></a>
</div>
</body>
</html>
