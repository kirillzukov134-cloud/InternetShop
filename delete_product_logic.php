<?php
session_start();
require_once 'db.php';
require 'function.php';

$deleteProduct = deleteProduct($pdo, $_GET['id']);

if ($deleteProduct) {
    redirect('product.php');
    exit;
} else {
    // $_SESSION['msg-error'] = 'Не удалось удалить товар';
    redirect('product.php');
    exit;
}
