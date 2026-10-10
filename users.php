<?php
require_once 'db.php';
require 'function.php';
$userAll = selectAllUsers($pdo);
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
        <h1 class="name-chapter">Пользователи</h1>
        <table>
            <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>