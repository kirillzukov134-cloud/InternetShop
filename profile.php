<?php
session_start();
require_once 'db.php';
require 'function.php';

$id = $_SESSION['user']['id'];
$userID = selectUserId($pdo, $id);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Профиль</title>
</head>
<body class="with-product">
    <?php include 'sidebar.php'; ?>
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
                        <a href="#" class="btn-switching">Изменить свои данные</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>