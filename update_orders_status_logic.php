<?php
require_once 'db.php';
require 'function.php';

$id = $_POST['id'];
$status =$_POST['status'];

if(updateOrderStatus($pdo, $id, $status)){
    redirect('ordersInfo.php');
    exit;
}else{
    redirect('update_order.php');
}