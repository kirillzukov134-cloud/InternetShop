<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_SESSION['user']['id'];
$userID = selectUserId($pdo, $id);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/main.css">
    <title>Профиль</title>
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Мой профиль</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Почта</th>
                    <th>Телефон</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $userID['id']?></td>
                    <td><?php echo $userID['name']?></td>
                    <td><?php echo $userID['email']?></td>
                    <td><?php echo $userID['phone']?></td>
                    <td>
                        <a href="update_user_profile.php?id=<?php echo $userID['id']; ?>" class="btn-switching">Изменить свои данные</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>