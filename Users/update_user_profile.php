<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_SESSION['user']['id'];
$user = selectUserId($pdo, $id);
// $categories = selectAllCategory($pdo);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/main.css">
    <title>Изменить статус</title>
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <form class="form-filling" action="update_user_logic.php" method="post" style="width: 350px">
            <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
        <label> Имя
            <input type="text" name="name" value="<?php echo $user['name'] ?>" placeholder="Введите имя">
        </label>
        <label> Почта
            <input type="email" name="email" value="<?php echo $user['email'] ?>" placeholder="Введите почту">
        </label>
        <label>Телефон
            <input type="number" name="phone" value="<?php echo $user['phone'] ?>" placeholder="Введите телефон">
        </label>
            <button type="submit" class="btn-add">Редактировать</button>
            <p>Передумали? <a href="users.php">Назад</a></p>
        </form>
    </main>
</body>
</html>