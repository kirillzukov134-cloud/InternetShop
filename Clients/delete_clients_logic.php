<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_GET['id'];
$deleteClient = deleteClient($pdo, $id);

if($deleteClient){
    $_SESSION['msg-success'] = 'Успешное удаление';
    redirect('clients.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при удалении';
    redirect('clients.php');
    exit;
}