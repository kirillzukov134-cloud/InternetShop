<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$products = selectAllProduct($pdo);
$clients = selectAllClients($pdo);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/cssmain.css">
    <title>Оформить заказ</title>
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
    <h1 class="name-chapter">Оформление заказа</h1>
        <?php
            if (!empty($_SESSION['msg-error']))
                echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        ?>
    <form class="form-filling" action="orders_logic.php" method="post" style="width: 80vh;">
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
        <?php endif; ?>
                <label>Товар:
                    <select name="product_id" class="option-category" required>
                        <option value="">Выберите товар</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?php echo $product['id'] ?>" 
                                    data-price="<?php echo $product['price'] ?>"
                                    data-stock="<?php echo $product['remains'] ?>">
                                <?php echo $product['name'] ?> 
                                <?php echo $product['price'] ?> остаток: 
                                <?php echo $product['remains'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>
                <label>Кол-во:
                    <input type="number" name="quantity" required>
                </label>
        <div>
            <button type="submit" class="btn-primary">Оформить заказ</button>
            <a href="ordersInfo.php" class="btn-secondary">Отмена</a>
        </div>
    </form>
</main>
</body>
</html>
