<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$name = $_POST['name'];
$password = $_POST['password'];

/*
1. Проверка капчи
2. Проверка блокировки после функции
3. Счетчик и проверка неверный/верный имя/логин
4. Успех
*/
$captcha = explode(',', $_POST['user_puzzle_order']);
if($captcha != $_SESSION['current_order']){
    $_SESSION['msg-error'] = 'Капча собрана неверно!';
    redirect('auth.php');
    exit;
}


$user = CheckClientAuth($pdo, $name, $password);

if($user && $user['is_blocked'] == 1){
    $_SESSION['msg-error'] = 'Вы заблокированы, обратитесь к администратору!';
    redirect('auth.php');
    exit;
}

if(!$user){
    if(!isset($_SESSION['attempts'][$name])){
        $_SESSION['attempts'][$name] = 0;
    }
    $_SESSION['attempts'][$name]++;
    if($_SESSION['attempts'][$name] >= 3){
        blockedUser($pdo, $name);
        $_SESSION['msg-error'] = 'Вы заблокированы, обратитесь к администратору!';
        redirect('auth.php');
        exit;
    } else {
        $_SESSION['msg-error'] = "Неверное имя или пароль.";
        redirect('auth.php');
        exit;
    }
}else{
    unset($_SESSION['current_order']);
    unset($_SESSION['attempts'][$name]);

    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'role' => $user['role'],
        'client_id' => $user['client_id']
    ];

    redirect('/../Users/sidebar.php');
    exit;
}
