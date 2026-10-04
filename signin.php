<?php
session_start();
require_once 'db.php';
require 'function.php';

$name = $_POST['name'];
$password = $_POST['password'];


$user = CheckClientAuth($pdo, $name, $password);

if($user){
    $_SESSION['user'] = [
        'id' => $user['id'],
        'name' => $user['name'],
        'role' => $user['role']
    ];

    if($user['role'] === 'Admin'){
        redirect('/settings.php');
        exit;
    }else{
        redirect('/sidebar.php');
        exit;
    }
}else{
    $_SESSION['msg-error'] = 'Неверное имя пользователя или пароль';
    redirect('/auth.php');
}

