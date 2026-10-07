<?php
require_once 'db.php';
require 'function.php';

$id = $_GET['id'];
$product = getProductById($pdo, $id);
$categories = selectAllCategory($pdo);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Изменить статус</title>
</head>
<body class="with-product">
    <?php include 'sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Изменить продукт под номер №<?php echo $product['id'] ?></h1>

        <form class="form-filling" action="update_product_logic.php" method="post"  style="width: 350px">
            <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
        <label> Название
            <input type="text" name="name" value="<?php echo $product['name'] ?>" placeholder="Введите название">
        </label>
        <label> Цена
            <input type="number" name="price" value="<?php echo $product['price'] ?>" placeholder="Введите цену">
        </label>
        <label> Остаток
            <input type="number" name="remains" value="<?php echo $product['remains'] ?>" placeholder="Введите остаток">
        </label>
        <label> Категория
            <select name="category_id">
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['id'] ?>"
                        <?php echo $category['id'] == $product['category_id']?>>
                        <?php echo $category['category'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
            <button type="submit" class="btn-add">Изменить продукт</button>
            <p>Передумали? <a href="product.php">Назад</a></p>
        </form>
    </main>
</body>
</html>