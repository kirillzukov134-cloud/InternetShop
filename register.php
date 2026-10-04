<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Регистрация</title>
</head>

<body class="form">
    <form action="/signup.php" method="post">
        <label> Имя
            <input type="text" name="name" placeholder="Введите имя">
        </label>
        <!-- <label> Логин
            <input 
            type="text"
            name="login"
            placeholder="Введите логин">
        </label> -->
        <label> Почта
            <input type="email" name="email" placeholder="Введите почту">
        </label>
        <label> Телефон
            <input type="phone" name="phone" placeholder="Введите номер телефона">
        </label>
        <label> Пароль
            <input type="password" name="password" placeholder="Введите пароль">
        </label>
        <label> Подтверждение пароля
            <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        </label>
        <button type="submit">
            Зарегистрироваться
        </button>
        <?php
        if (!empty($_SESSION['msg-error']))
            echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
        unset($_SESSION['msg-error']);
        ?>
        <p>
            У вас есть акканут?<a href="auth.php"> авторизируйтесь</a>
        </p>
    </form>
</body>

</html>