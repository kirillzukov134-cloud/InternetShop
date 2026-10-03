<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Авторизация</title>
</head>
<body class="form">
    <form action="signin.php" method="post">
        <label> Имя
            <input 
            type="text"
            name="name"
            placeholder="Введите Имя">
        </label>
        <label> Пароль
            <input 
            type="password"
            name="password"
            placeholder="Введите пароль">
        </label>
        <button type="submit">
            Авторизоваться
        </button>
        <?php
            if(!empty($_SESSION['msg-success']))
                echo '<p class="msg-success">' . $_SESSION['msg-success'] . '</p>';
            unset($_SESSION['msg-success']);
            
            if(!empty($_SESSION['msg-error']))
                echo '<p class="msg-error">' . $_SESSION['msg-error'] . '</p>';
            unset($_SESSION['msg-error']);
        ?>
        <p>
            У вас нет акканута?<a href="register.php"> зарегистрируйтесь</a>
        </p>
    </form>
</body>
</html>