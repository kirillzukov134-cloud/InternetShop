<?php
session_start();
$correct = [1,2,3,4];
$shuffled = $correct;
shuffle($shuffled);
$_SESSION['current_order'] = $correct;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Авторизация</title>
</head>

<body class="form">
    <form action="signin.php" method="post">
        <label> Имя
            <input type="text" name="name" placeholder="Введите Имя">
        </label>
        <label> Пароль
            <input type="password" name="password" placeholder="Введите пароль">
        </label>
        <div class="captcha-cont">
            <?php foreach($shuffled as $value): ?>
                <img class="captcha"
                src="/assets/img/<?php echo $value ?>.png"
                draggable="true"
                id="captcha"
                data-id="<?php echo $value ?>">
            <?php endforeach; ?>
        </div>

        <input type="hidden" name="user_puzzle_order" id="user_puzzle_order">
        <button type="submit">
            Авторизоваться
        </button>
        <?php
        if (!empty($_SESSION['msg-success']))
            echo '<p class="msg-success">' . $_SESSION['msg-success'] . '</p>';
        unset($_SESSION['msg-success']);

        if (!empty($_SESSION['msg-error']))
            echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
        unset($_SESSION['msg-error']);
        ?>
        <p>
            У вас нет акканута?<a href="../auth/register.php"> зарегистрируйтесь</a>
        </p>
    </form>
    <script src="../assets/js/captcha.js"></script>
</body>

</html>