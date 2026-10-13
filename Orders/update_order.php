<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_GET['id'];
$order = getOrderById($pdo, $id);

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Изменить статус</title>
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Изменить статус заказа №<?php echo $order['id'] ?></h1>

        <form class="form-filling" action="update_orders_status_logic.php" method="post">
            <input type="hidden" name="id" value="<?php echo $order['id'] ?>">
            <label class="form-name"> Новый статус
                <select name="status" class="option-category" required>
                    <option value="Активный" <?php echo $order['status'] === 'Активный' ?>>Активный</option>
                    <option value="В процессе" <?php echo $order['status'] === 'В процессе' ?>>В процессе</option>
                    <option value="Завершён" <?php echo $order['status'] === 'Завершён' ?>>Завершён</option>
                    <option value="Прервано" <?php echo $order['status'] === 'Прервано' ?>>Прервано</option>
                </select>
            </label>
            <button type="submit" class="btn-add">Сохранить</button>
            <p>
                Передумали? <a href="ordersInfo.php">Назад</a>
            </p>
            <?php
                if (!empty($_SESSION['msg-error']))
                    echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
                unset($_SESSION['msg-error']);
            ?>
        </form>
    </main>
</body>
</html>