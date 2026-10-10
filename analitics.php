<?php
require_once 'db.php';
require 'function.php';
// $userAll = selectAllUsers($pdo);
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
        <h1 class="name-chapter">Аналитика</h1>
        <h2 class="name-chapter">Общая выручка</h2>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
        <h1 class="name-chapter">Выручка по категориям</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
        <h1 class="name-chapter">Топ-5 товаров </h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
        <h1 class="name-chapter">Топ-5 клиентов </h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
        <h1 class="name-chapter">Статистика по статусам заказов </h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
        <h1 class="name-chapter">Средний чек </h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <!-- <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <a class="btn-switching" href="#">Удалить |</a>
                            <a class="btn-switching" href="#">Редактировать</a>
                        </th>
                    </tr>
                <?php endforeach; ?> -->
            </tbody>
        </table>
    </main>
</body>

</html>