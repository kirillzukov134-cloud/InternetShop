<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';
$clientsAll = selectAllClients($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/cssmain.css">
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Клиенты</h1>
            <div class="form-buttons">
                <a href="add_client.php" class="btn-add">Добавить клиента</a>
            </div>
        <table>
            <thead>
                <tr>
                    <th>ID Клиента</th>
                    <th>Имя</th>
                    <th>Почта</th>
                    <th>Номер телефона</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clientsAll as $client): ?>
                    <tr>
                        <th><?php echo $client['id'] ?></th>
                        <th><?php echo $client['name'] ?></th>
                        <th><?php echo $client['email'] ?></th>
                        <th><?php echo $client['phone'] ?></th>
                        <th>
                            <a class="btn-switching" href="update_client.php?id=<?php echo $client['id']; ?>">Редактировать |</a>
                            <a class="btn-switching" href="delete_clients_logic.php?id=<?php echo $client['id']; ?>">Удалить</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
        if (!empty($_SESSION['msg-success'])) {
                echo '<p class="msg-success">' . $_SESSION['msg-success'] . '</p>';
            unset($_SESSION['msg-success']);
        }
        if (!empty($_SESSION['msg-error']))
            echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
        unset($_SESSION['msg-error']);
        ?>
    </main>
</body>

</html>