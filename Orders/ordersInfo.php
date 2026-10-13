<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$status = $_POST['status'];
$name = $_POST['name'];
$time = $_POST['time'];

if($status){
    $orders = filterationStatusOrder($pdo, $status);
}elseif($name){
    $orders = filterationClientName($pdo, $name);
}elseif($time){
    $orders = filterationClientTime($pdo, $time);
}else{
    $orders = getOrdersAndClients($pdo);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/cssmain.css">
    <title>Список заказов</title>
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Мои заказы</h1>
        <form method="POST">
            <input type="text" name="status" class="input-search-category" value="<?php echo $status ?>" placeholder="Введите статус">
            <input type="text" name="name" class="input-search-category" value="<?php echo $name ?>" placeholder="Введите имя">
            <input type="text" name="time" class="input-search-category" value="<?php echo $time ?>" placeholder="Введите время">
            <button class="btn-search" type="submit">Найти</button>
            <a href="ordersInfo.php" class="btn-search">Сбросить</a>
        </form>
        <!-- <div class="form-buttons">
            <a href="orders.php" class="btn-primary">Создать заказ</a>
        </div> -->
        <!-- <h2>Ваш заказ</h2> -->
        <table class="">
            <thead>
                <tr>
                    <th>ID заказа</th>
                    <th>Клиент</th>
                    <th>Дата создания</th>
                    <th>Товар</th>
                    <th>Количество</th>
                    <th>Сумма (руб.)</th>
                    <th>Статус</th>
                <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                    <th>Действие</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['id'] ?></td>
                            <td><?php echo $order['client_name'] ?></td>
                            <td><?php echo $order['created_at'] ?></td>
                            <td><?php echo $order['product_name'] ?></td>
                            <td><?php echo $order['quanitity'] . ' шт.'?></td>
                            <td><?php echo $order['total_amount'] . ' рублей' ?></td>
                            <td><?php echo $order['status'] ?></td>
                            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                            <td>
                                <a href="update_order.php?id=<?php echo $order['id'] ?>" class="btn-switching">Редактировать статус</a>
                                <!-- <a href="update_order.php?id=<?php echo $order['id'] ?>" class="btn-switching">Редактировать статус</a> -->
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>