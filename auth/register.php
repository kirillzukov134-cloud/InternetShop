<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/main.css">
    <title>Регистрация</title>
</head>

<body class="form">
    <form class="form-filling" action="signup.php" method="post">
        <label class="field-names"> Имя
            <input  type="text" name="name" placeholder="Введите имя">
        </label>
        <!-- <label> Логин
            <input 
            type="text"
            name="login"
            placeholder="Введите логин">
        </label> -->
        <label class="field-names"> Почта
            <input type="email" name="email" placeholder="Введите почту">
        </label>
        <label class="field-names"> Телефон
            <input type="phone" name="phone" placeholder="Введите номер телефона">
        </label>
        <label class="field-names"> Пароль
            <input type="password" name="password" placeholder="Введите пароль">
        </label>
        <label class="field-names"> Подтверждение пароля
            <input type="password" name="password_confirm" placeholder="Подтвердите пароль">
        </label>
        <button class="btn-transition" type="submit">
            Зарегистрироваться
        </button>
        <?php
            if (!empty($_SESSION['msg-error']))
                echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        ?>
        <p  class="msg-question">
            У вас есть акканут?<a href="../auth/auth.php" class="link-pagination"> авторизируйтесь</a>
        </p>
    </form>
</body>

</html>