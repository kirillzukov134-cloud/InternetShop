<?php
session_start();
require_once 'db.php';
require 'function.php';
$ordersAll = selectAllOrders($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
</head>

<body class="with-product">
    <?php include 'sidebar.php'; ?>
    <main class="content">
    <?php if($_SESSION['user']['role'] === 'Admin'): ?>
        <h1 class="name-chapter">Все заказы клиентов</h1>
    <?php else: ?>
        <h1 class="name-chapter">Мои заказы</h1>
    <?php endif; ?>     
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Клиент</th>
                    <th>Дата создания товара</th>
                    <th>Общая сумма</th>
                    <th>Статус</th>
                <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                    <th>Действия</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersAll as $orders): ?>
                    <tr>
                        <th><?php echo $orders['id'] ?></th>
                        <th><?php echo $orders['Клиент'] ?></th>
                        <th><?php echo $orders['Дата_создания_заказа'] ?></th>
                        <th><?php echo $orders['Общая_сумма'] . ' руб.' ?></th>
                        <th><?php echo $orders['Статус'] ?></th>
                        <th>
                        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                            <a href="#" class="btn-switching">Изменить товар |</a>
                            <a href="#" class="btn-switching">Удалить товар</a>
                        <?php endif; ?>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>