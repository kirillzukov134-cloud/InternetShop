<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/main.css">
    <title>Интернет магазин</title>
</head>

<body class="with-sidebar">
    <aside class="sidebar-menu">
        <div class="logo">
            <h1><a href="../Users/sidebar.php" class="logo-name">InternetShop</a></h1>
        </div>
        <!-- Меню кнопок -->
        <div class="sidebar">
            <div class="sidebar-btns">
                <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                    <!-- Для админа -->
                    <a class="btns" href="/../Products/product.php">Товары</a>
                    <a class="btns" href="/../Categories/categories.php">Категории</a>
                    <!-- <a class="btns" href="clients.php">Пользователи</a> -->
                    <a class="btns" href="/../Clients/clients.php">Список всех клиентов</a>
                    <a class="btns" href="/../Orders/orders.php">Оформить заказ</a>
                    <!-- <a class="btns" href="orders.php">Добавить заказ</a> -->
                    <a class="btns" href="/../Orders/ordersInfo.php">Все заказы</a>
                    <a class="btns" href="/../analytics/analytics.php">Аналитика</a>
                <?php else: ?>
                    <!-- Для пользователя -->
                    <a class="btns" href="/../Products/product.php">Товары</a>
                    <a class="btns" href="/../Categories/categories.php">Категории</a>
                    <a class="btns" href="/../Orders/orders.php">Оформить заказ</a>
                    <a class="btns" href="/../Orders/ordersInfo.php">Мои заказы</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="sidebar-footer">
        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
            <a href="/Users/users.php">Пользователи</a>
        <?php endif; ?>
            <a href="/Users/profile.php">Мой профиль</a>
            <a href="/../auth/logout.php">Выход</a>
        </div>
    </aside>
</body>

</html>