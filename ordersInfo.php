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
                    Clients.name AS client_name 
            FROM Orders 
            INNER JOIN Clients ON Orders.client_id = Clients.id 
            ORDER BY Orders.created_at DESC";
    $statement = $pdo->query($sql);
} else {
    $sql = "SELECT Orders.id, 
                    Orders.client_id, 
                    Orders.created_at, 
                    Orders.total_amount, 
                    Orders.status, 
                    Clients.name AS client_name 
            FROM Orders 
            INNER JOIN Clients ON Orders.client_id = Clients.id 
            WHERE Orders.client_id = :client_id 
            ORDER BY Orders.created_at DESC";
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
        <h1 class="name-chapter">Список заказов</h1>
        
        <div class="form-buttons">
            <a href="orders.php" class="btn-primary">Создать заказ</a>
        </div>

        <table class="table-orders">
            <thead>
                <tr>
                    <th>ID заказа</th>
                    <th>Клиент</th>
                    <th>Дата создания</th>
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
                            <td><?= $order['id'] ?></td>
                            <td><?= htmlspecialchars($order['client_name']) ?></td>
                            <td><?= $order['created_at'] ?></td>
                            <td><?= $order['total_amount'] ?></td>
                            <td><?= htmlspecialchars($order['status']) ?></td>
                            <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
                            <td>
                                <a href="update_order.php?id=<?php echo $order['id'] ?>" class="btn-switching">Редактировать статус</a>
                            </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>