<?php
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$totals = totalRevenueSumm($pdo);
$totalsCategories = revenueByCategory($pdo);
$topProducts =  byNumberOfUnitsSold($pdo);
$topClients = byNumberOfClients($pdo);
$staticStatusProducts = staticStatusProducts($pdo);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../assets/css/main.css">
</head>
<body class="with-product">
    <?php include '../Users/sidebar.php'; ?>
    <main class="content">
        <h1 class="name-chapter">Аналитика</h1>
        <h2 class="name-chapter" style="margin-top: 15px;">Общая выручка</h2>
        <table>
            <thead>
                <tr>
                    <th>Общая сумма — сумма всех заказов со статусом “доставлен”.</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($totals as $total): ?>
                    <tr>
                        <th><?php echo $total['Сумма'] . ' руб.' ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h1 class="name-chapter" style="margin-top: 15px;">Выручка по категориям</h1>
        <table>
            <thead>
                <tr>
                    <th>Выручка по категориям — сколько денег принесла каждая категория (по доставленным заказам).</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($totalsCategories as $totalsCategory): ?>
                    <tr>
                        <th><?php echo $totalsCategory['Категория'] . " - " . $totalsCategory['Сумма'] . " руб." ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h1 class="name-chapter" style="margin-top: 15px;">Топ-5 товаров</h1>
        <table>
            <thead>
                <tr>
                    <th>Самые продаваемые товары по количеству проданных единиц</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topProducts as $topProduct): ?>
                    <tr>
                        <th><?php echo $topProduct['name'] ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h1 class="name-chapter" style="margin-top: 15px;">Топ-5 клиентов</h1>
        <table>
            <thead>
                <tr>
                    <th>клиенты, потратившие больше всего денег</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topClients as $topClient): ?>
                    <tr>
                        <th><?php echo "Клиент: " .  $topClient['Клиент'] . " - " . $topClient['Общая_сумма'] . " руб."?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h1 class="name-chapter" style="margin-top: 15px;">Статистика по статусам заказов</h1>
        <table>
            <thead>
                <tr>
                    <th>сколько заказов в каждом статусе</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staticStatusProducts as $staticStatusProduct): ?>
                    <tr>
                        <th><?php echo $staticStatusProduct['Статус'] . " - " . $staticStatusProducts['Всего_заказов'] ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h1 class="name-chapter" style="margin-top: 15px;">Средний чек </h1>
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