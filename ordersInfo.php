<?php
session_start();
require_once 'db.php';
require 'function.php';

if ($_SESSION['user']['role'] === 'Admin') {
    $sql = "SELECT Orders.id, 
                    Orders.client_id, 
                    Orders.created_at, 
                    Orders.total_amount, 
                    Orders.status, 
                    Clients.name AS client_name, 
                    Product.name AS product_name,
                    Order_position.quanitity 
            FROM Orders 
            JOIN Clients ON Orders.client_id = Clients.id 
            JOIN Order_position ON Order_position.order_id = Orders.id 
            JOIN Product ON Product.id = Order_position.product_id;";
    $statement = $pdo->query($sql);
} else {
    $sql = "SELECT Orders.id, 
                    Orders.client_id, 
                    Orders.created_at, 
                    Orders.total_amount, 
                    Orders.status, 
                    Clients.name AS client_name, 
                    Product.name AS product_name,
                    Order_position.quanitity 
            FROM Orders 
            JOIN Clients ON Orders.client_id = Clients.id 
            JOIN Order_position ON Order_position.order_id = Orders.id 
            JOIN Product ON Product.id = Order_position.product_id
            WHERE Orders.client_id = :client_id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':client_id' => $_SESSION['user']['client_id']
    ]);
}
$orders = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Список заказов</title>
</head>
<body class="with-product">
    <?php include 'sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Мои заказы</h1>
    
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