<?php
session_start();
require_once 'db.php';
require 'function.php';

$name = $_POST['name'];
$password = $_POST['password'];


if (CheckClientAuth($pdo, $name, $password)) {
    redirect('users.php');
    exit;
} else {
    $_SESSION['msg-error'] = "Неверное имя пользователя или пароль.";
    redirect('auth.php');
    exit;
}