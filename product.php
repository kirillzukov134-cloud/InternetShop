<?php
session_start();
require_once 'db.php';
require 'function.php';
$productAll = selectAllProduct($pdo);
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
        <h1 class="name-chapter">Раздел с товарами</h1>
        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
            <a class="btn-add" href="add_product.php">Добавить продукт</a>
            <div class="search">
                <input type="text" name="name" class="input-search" value="" placeholder="Поиск по названию">
                <a href="#" class="btn-search">Найти</a>
            </div>
        <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Номер товара</th>
                    <th>Название товара</th>
                    <th>Цена товара (за шт.)</th>
                    <th>Количество товара</th>
                    <th>Категория товара</th>
                <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                    <th>Действия</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productAll as $product): ?>
                    <tr>
                        <th><?php echo $product['id'] ?></th>
                        <th><?php echo $product['name'] ?></th>
                        <th><?php echo $product['price'] . ' руб.' ?></th>
                        <th><?php echo $product['remains'] . 'шт.' ?></th>
                        <th><?php echo $product['category_name'] ?></th>
                        <th>
                        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                            <a href="update_product.php" class="btn-switching">Изменить товар |</a>
                            <a href="delete_product_logic.php?id=<?php echo $product['id'] ?>" class="btn-switching">Удалить товар</a>
                        <?php endif; ?>
                        </th>
                    </tr>
                <?php
                    if (!empty($_SESSION['msg-error']))
                        echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
                    unset($_SESSION['msg-error']);
                ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>