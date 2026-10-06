<?php
require_once 'db.php';
require 'function.php';

$id = $_GET['id'];
$deleteProduct = deleteProduct($pdo, $id);

if ($deleteProduct) {
    redirect('product.php');
    exit;
} else {
    $_SESSION['msg-error'] = 'Не удалось удалить товар';
    redirect('product.php');
    exit;
}
