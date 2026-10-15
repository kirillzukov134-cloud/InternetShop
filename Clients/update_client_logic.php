<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(updateClients($pdo, $id, $name, $email, $phone)){
    $_SESSION['msg-success'] = 'Успешное редактирование';
    redirect('clients.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при редактировании';
    redirect('update_client.php');
    exit;
}
