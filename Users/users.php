<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';
$userAll = selectAllUsers($pdo);
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
        <h1 class="name-chapter">Пользователи</h1>
        <table>
            <thead>
                <tr>
                    <th>Имя пользователя</th>
                    <th>Действия (если пользователь заблокирован)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userAll as $user): ?>
                    <tr>
                        <th><?php echo $user['name'] ?></th>
                        <th>
                            <!-- Если есть блокировка -->
                            <?php if($user['is_blocked'] == 1): ?>
                            <a class="btn-switching" href="unblock_user.php?id=<?php echo $user['id'] ?>">Разблокировать |</a>
                            <?php endif;?>

                            <!-- Для админа -->
                            <?php if($_SESSION['user']['role'] === 'Admin'): ?>
                            <a class="btn-switching" href="delete_user.php?id=<?php echo $user['id'] ?>&client_id=<?php echo $user['client_id']; ?>">Удалить пользователя</a>
                            <?php endif; ?>
                        </th>
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