<?php
require_once 'db.php';
require 'function.php';

$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$remains = $_POST['remains'];
$category_id = $_POST['category_id'];

if (updateProduct($pdo, $id, $name, $price, $remains, $category_id)) {
    redirect('product.php');
} else {
    redirect('update_product.php?id=' . $id);
}