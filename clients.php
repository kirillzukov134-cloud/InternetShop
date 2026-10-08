<?php
require_once 'db.php';
require 'function.php';
$clientsAll = selectAllClients($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
</head>
<body class="with-product">
    <?php include 'sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Клиенты</h1>
            <div class="form-buttons">
                <a href="add_client.php" class="btn-primary">Добавить клиента</a>
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
                            <a class="btn-switching" href="#">Удаление</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>