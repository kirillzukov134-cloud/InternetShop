<?php
session_start();
require_once 'db.php';
require 'function.php';

$name = $_POST['name'];
$price = $_POST['price'];
$remains = $_POST['remains'];
$category_id = $_POST['category_id'];


if(insertProduct($pdo, $name, $price, $remains, $category_id)){
    // $_SESSION['msg-success'] = 'Успешное добавление';
    redirect('product.php');
    exit;
}else{
    // $_SESSION['msg-error'] = 'Ошибка при добавлении';
    redirect('add_product.php');
    exit;
}