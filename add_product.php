<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление товара</title>
</head>
<body>
    <?php include 'sidebar.php';?>
        <!-- <h1 class="name-chapter">Форма добавления товара</h1> -->
    <form class="form-filling" action="add_product_logic.php" method="post">
        <lable class="form-name"> Название товара
            <input class="fill_line" type="text" name="name" placeholder="Введите название продукта">
        </lable>
        <lable class="form-name"> Цена
            <input class="fill_line" type="number" name="price" placeholder="Введите цену">
        </lable>
        <lable class="form-name"> Количество
            <input class="fill_line" type="number" name="remains" placeholder="Укажите количество (шт.)">
        </lable>
        <lable class="form-name"> Категория
            <select class="option-category">
                <option value="">Выберите категорию</option>
                <option value="1">Одежда</option>
                <option value="2">Электроника</option>
                <option value="3">Книга</option>
            </select>
        </lable>
        <button class="btn-add" type="submit">Добавить продукт</button>
        <p>
            Передумали? <a href="product.php">Назад</a>    
        </p>
    </form>
</body>
</html>