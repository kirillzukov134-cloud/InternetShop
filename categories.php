<?php
require_once 'db.php';
require 'function.php';
$categoriesAll = selectAllCategory($pdo);
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
        <h1 class="name-chapter">Раздел с товарами</h1>
        <table>
            <thead>
                <tr>
                    <th>Номер категории</th>
                    <th>Название категории</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoriesAll as $category): ?>
                    <tr>
                        <th><?php echo $category['id'] ?></th>
                        <th><?php echo $category['category'] ?></th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>