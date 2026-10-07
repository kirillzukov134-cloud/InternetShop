<?php
session_start();
require_once 'db.php';
require 'function.php';

$products = selectAllProduct($pdo);
$clients = selectAllClients($pdo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="main.css">
    <title>Оформить заказ</title>
</head>
<body class="with-product">
    <?php include 'sidebar.php'; ?>
    <main class="content">
    <h1 class="name-chapter">Оформление заказа</h1>
        <?php
            if (!empty($_SESSION['msg-error']))
                echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        ?>
    <form class="form-filling" action="orders_logic.php" method="post">
        <?php if ($_SESSION['user']['role'] === 'Admin'): ?>
            <label class="form-name"> Клиент
                <select name="client_id" class="option-category" required>
                    <option value="">Выберите клиента</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo $client['id'] ?>">
                            <?php echo $client['name'] ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </label>
        <?php else: ?>
            <input type="hidden" name="client_id" value="<?php echo $_SESSION['user']['client_id'] ?>">
            <p>Клиент: <b><?php echo $_SESSION['user']['name'] ?></b></p>
        <?php endif; ?>
        <div id="items">
            <div class="item-row">
                <label>Товар:
                    <select name="product_id" class="option-category" required>
                        <option value="">Выберите товар</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product['id'] ?>" 
                                    data-price="<?= $product['price'] ?>"
                                    data-stock="<?= $product['remains'] ?>">
                                <?php echo $product['name'] ?> 
                                <?php echo $product['price'] ?>рублей, остаток: 
                                <?php echo $product['remains'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Кол-во:
                    <input type="number" name="quantity" required>
                </label>
            </div>
        </div>

        <div class="form-buttons">
            <button type="submit" class="btn-primary">Оформить заказ</button>
            <a href="ordersInfo.php" class="btn-secondary">Отмена</a>
        </div>
    </form>
</main>
</body>
</html>
