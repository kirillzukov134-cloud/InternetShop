<?php
session_start();
require_once 'db.php';
require 'function.php';
$product_id = $_POST['product_id'];
$category_id = $_POST['category_id'];

if (!empty($category_id)) {
    $productAll = filtrationCategory($pdo, $category_id);
} elseif(!empty($product_id)){
    $productAll = filterationProduct($pdo, $product_id);
}else {
    $productAll = selectAllProduct($pdo);  
}

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
                <form method="POST">
                    <input type="text" name="category_id" class="input-search-category" value="<?php echo $category_id?>" placeholder="Введите категорию">
                    <input type="text" name="product_id" class="input-search-product" value="<?php echo $product_id?>" placeholder="Введите товар">
                    <button class="btn-search" type="submit">Найти</button>
                    <a href="product.php" class="btn-search">Сбросить</a>
                </form>
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
                        <td><?php echo $product['id']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td><?php echo $product['price'] . ' руб.'; ?></td>
                        <td><?php echo $product['remains'] . ' шт.'; ?></td>
                        <td><?php echo $product['category_name']; ?></td>
                        <td>
                        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                            <a href="update_product.php?id=<?php echo $product['id']; ?>" class="btn-switching">Изменить товар |</a>
                            <a href="delete_product_logic.php?id=<?php echo $product['id']; ?>" class="btn-switching">Удалить товар</a>
                        <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php
        if (!empty($_SESSION['msg-error'])) {
            echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        }
    ?>
    </main>
</body>
</html>