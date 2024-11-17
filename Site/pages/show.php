<?php
$dsn = 'mysql:host=localhost;dbname=pictures;charset=utf8';
$username = 'root';
$password = '';
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
$pdo = new PDO($dsn, $username, $password, $options);

$image = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['image_id']))
{
    $stmt = $pdo->prepare("SELECT * FROM Pictures WHERE id = ?");
    $stmt->execute([$_POST['image_id']]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);
}

$images = $pdo->query("SELECT id, name FROM Pictures")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Перегляж зображень</title>
    <link rel="stylesheet" href="../pages/styles.css">
</head>
<body>
<div class="container">
    <h1>Перегляд зображення</h1>
    <form action="show.php" method="post">
        <select name="image_id" required>
            <option value="">Оберіть зображення</option>
            <?php foreach ($images as $img): ?>
                <option value="<?= $img['id'] ?>"><?= $img['name'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Показати</button>
    </form>

    <?php if ($image): ?>
        <h2>Інформація про зображення</h2>
        <img src="../images/<?= htmlspecialchars($image['name']) ?>" alt="<?= htmlspecialchars($image['name']) ?>" style="max-width: 100%; height: auto;">
        <p>Им'я файлу: <?= htmlspecialchars($image['name']) ?></p>
        <p>Розмір: <?= $image['size'] ?> байт</p>
    <?php endif; ?>
    <br>
    <a href="../index.php"><button class="home">На головну</button></a>
</div>
</body>
</html>
