<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(insertClients($pdo, $name, $email, $phone)){
    $_SESSION['msg-success'] = 'Успешное добавление';
    redirect('clients.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при добавлении';
    redirect('add_client.php');
}