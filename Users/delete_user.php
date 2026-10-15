<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_GET['id'];
$client_id = $_GET['client_id'];
$deleteUsersAndClients = deleteUsersAndClient($pdo, $id, $client_id);

if($deleteUsersAndClients ){
    $_SESSION['msg-success'] = 'Успешное удаление пользователя (он же и клиент)';
    redirect('users.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при удалении, у пользователя есть заказ!';
    redirect('users.php');
    exit;
}