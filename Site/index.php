<?php
$dsn = 'mysql:host=localhost;dbname=pictures;charset=utf8';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$pdo = new PDO($dsn, $username, $password, $options);

$query = $pdo->query("SELECT COUNT(*) as count FROM Pictures");
$count = $query->fetch(PDO::FETCH_ASSOC)['count'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Головна</title>
    <link rel="stylesheet" href="./pages/styles.css">
</head>
<body>
<div class="container">
    <h1>Головна сторінка</h1>
    <p>Кількість зображень у базі даних: <?= $count ?></p>
    <a href="pages/upload.php"><button>Завантажити зображення</button></a><br><br>
    <a href="pages/show.php"><button class="show">Перегляд зображень</button></a>
</div>
</body>
</html>
