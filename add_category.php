<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление товара</title>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <form class="form-filling" action="add_category_logic.php" method="post">
        <label class="form-name"> Название категории
            <input class="fill_line" type="text" name="category" placeholder="Введите название категории">
        </label>
        <button class="btn-add" type="submit">Добавить категорию</button>
        <p>
            Передумали? <a href="categories.php">Назад</a>    
        </p>
    </form>
</body>
</html>