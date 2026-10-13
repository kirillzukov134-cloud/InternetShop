<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_POST['id'];
$status =$_POST['status'];

if(updateOrderStatus($pdo, $id, $status)){
    $_SESSION['msg-success'] = 'Успешное редактирование';
    redirect('ordersInfo.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при редактировании';
    redirect('update_order.php');
    exit;
}