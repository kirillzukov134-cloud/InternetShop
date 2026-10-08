<?php
require_once 'db.php';
require 'function.php';

$id = $_GET['id'];
$client = getClientById($pdo, $id);

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
        <h1 class="name-chapter">Изменить клиента №<?php echo $client['id'] ?></h1>

        <form class="form-filling" style="width: 350px;" action="update_client_logic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $client['id'] ?>">
                <label class="form-name"> Имя
                    <input type="text" name="name" value="<?php echo $client['name'] ?>">
                </label>
                <label class="form-name"> Почта
                    <input type="email" name="email" value="<?php echo $client['email'] ?>">
                </label>
                <label class="form-name"> Телефон
                    <input type="tel" name="phone" value="<?php echo $client['phone'] ?>">
                </label>
            <button type="submit" class="btn-add">Сохранить</button>
            <p>Передумали? <a href="clients.php">Назад</a></p>
        </form>
    </main>
</body>
</html>
