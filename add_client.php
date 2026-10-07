<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление товара</title>
</head>
<body>
    <?php include 'sidebar.php'; ?>
    <form class="form-filling" action="add_client_logic.php" method="post">
        <label class="form-name"> Имя
            <input class="fill_line" type="text" name="name" placeholder="Введите имя">
        </label>
        <label class="form-name"> Почта
            <input class="fill_line" type="email" name="email" placeholder="Введите почту">
        </label>
        <label class="form-name"> Телефон
            <input class="fill_line" type="phone" name="phone" placeholder="Введите телефон">
        </label>
        <button class="btn-add" type="submit">Добавить клиента</button>
        <p>
            Передумали? <a href="clients.php">Назад</a>    
        </p>
    </form>
</body>
</html>