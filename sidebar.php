<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Интернет магазин</title>
</head>

<body class="with-sidebar">
    <aside class="sidebar-menu">
        <div class="logo">
            <h1>InternetShop</h1>
        </div>
        <!-- Меню кнопок -->
        <div class="sidebar">
            <div class="sidebar-btns">
                <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                    <!-- Для админа -->
                    <a class="btns" href="product.php">Товары</a>
                    <a class="btns" href="categories.php">Категории</a>
                    <a class="btns" href="clients.php">Пользователи</a>
                    <a class="btns" href="add_product.php">Добавить товар</a>
                    <a class="btns" href="add_category.php">Добавить категорию</a>
                    <!-- <a class="btns" href="orders.php">Добавить заказ</a> -->
                    <a class="btns" href="orders.php">Все заказы</a>
                <?php else: ?>
                    <!-- Для пользователя -->
                    <a class="btns" href="product.php">Товары</a>
                    <a class="btns" href="categories.php">Категории</a>
                    <a class="btns" href="#">Оформить заказ</a>
                    <a class="btns" href="orders.php">Мои заказы</a>
                <?php endif; ?>
            </div>
        </div>
        <div class="sidebar-footer">
        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
            <a href="#">Пользователи</a>
        <?php endif; ?>
            <a href="#">Мой профиль</a>
            <a href="logout.php">Выход</a>
        </div>
    </aside>
</body>

</html>