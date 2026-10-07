<?php
session_start();
require_once 'db.php';
require 'function.php';

$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];
$role = 'User';

// 1. Проверка на пустые поля
if(empty($name) || empty($phone) || empty($email) || empty($password) || empty($password_confirm)) {
    $_SESSION['msg-error'] = 'Все поля должны быть заполнены';
    redirect('register.php');
    exit;
}

// 2. Проверка на совпадение паролей
if($password !== $password_confirm){
    $_SESSION['msg-error'] = 'Пароли не совпадают';
    redirect('register.php');
    exit;
}

// 3. Проверка, занята ли почта
if (CheckClientsReg($pdo, $email)) {
    $_SESSION['msg-error'] = 'Почта уже занята';
    redirect('register.php');
    exit;
}

insertClients($pdo, $name, $email, $phone);
$client_id = $pdo->lastInsertId();

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
if (insertUsers($pdo, $name, $email, $phone, $passwordHash, $role, $client_id)) {
    $_SESSION['msg-success'] = 'Успешная регистрация';
    redirect('auth.php');
    exit;
} else {
    $_SESSION['msg-error'] = 'Ошибка при регистрации';
    redirect('register.php');
    exit;
}