<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';
$categoriesAll = selectAllCategory($pdo);
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
        <h1 class="name-chapter">Категории</h1>
    <?php if($_SESSION['user']['role'] === 'Admin'): ?>
        <a class="btn-add" href="add_category.php">Добавить категорию</a>
    <?php endif; ?>
        <table>
            <thead>
                <tr>
                    <th>Номер категории</th>
                    <th>Название категории</th>
                <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                    <th>Действие</th>
                <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categoriesAll as $category): ?>
                    <tr>
                        <th><?php echo $category['id'] ?></th>
                        <th><?php echo $category['category'] ?></th>
                        <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                        <th>
                            <a class="btn-switching" href="delete_category_logic.php?id=<?php echo $category['id']; ?>">Удалить</a>
                        </th>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php
            if (!empty($_SESSION['msg-success']))
                echo '<p class="msg-success">' . $_SESSION['msg-success'] . '</p>';
            unset($_SESSION['msg-success']);

            if (!empty($_SESSION['msg-error']))
                echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        ?>
    </main>
</body>

</html>