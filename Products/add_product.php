<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';
$addCategory = selectAllCategory($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление товара</title>
</head>
<body>
    <?php include '../Users/sidebar.php';?>
        <!-- <h1 class="name-chapter">Форма добавления товара</h1> -->
    <form class="form-filling" action="add_product_logic.php" method="post">
        <lable class="form-name"> Название товара
            <input class="fill_line" type="text" name="name" placeholder="Введите название продукта">
        </lable>
        <lable class="form-name"> Цена (руб.)
            <input class="fill_line" type="number" name="price" placeholder="Введите цену">
        </lable>
        <lable class="form-name"> Количество (шт.)
            <input class="fill_line" type="number" name="remains" placeholder="Укажите количество (шт.)">
        </lable>
        <lable class="form-name"> Категория
            <select class="option-category" name="category_id">
                <option value="">Выберите категорию</option>
                <?php foreach($addCategory as $category): ?>
                <option value="<?php echo $category['id'] ?>"> <?php echo $category['category'] ?></option>
                <?php endforeach; ?>
            </select>
        </lable>
        <button class="btn-add" type="submit">Добавить продукт</button>
        <?php
        if (!empty($_SESSION['msg-success']))
            echo '<p class="msg-success">' . $_SESSION['msg-success'] . '</p>';
        unset($_SESSION['msg-success']);

        if (!empty($_SESSION['msg-error']))
            echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
        unset($_SESSION['msg-error']);
        ?>
        <p>
            Передумали? <a href="product.php">Назад</a>    
        </p>
    </form>
</body>
</html>