<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';


$client_id  = $_POST['client_id'];
$product_id = $_POST['product_id'];
$quantity   = $_POST['quantity'];


$product = getProductById($pdo, $id);
$price = $product['price'];
$total = $price * $quantity;

$order_id = addOrder($pdo, $client_id);
addOrderPosition($pdo, $order_id, $product_id, $quantity, $price);
descreaseRemainder($pdo, $product_id, $quantity);
updateSumm($pdo, $order_id, $total);


redirect('ordersInfo.php');