<?php
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
        <table>
            <thead>
                <tr>
                    <th>Номер товара</th>
                    <th>Название товара</th>
                    <th>Цена товара</th>
                    <th>Количество товара</th>
                    <th>Категория товара</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>