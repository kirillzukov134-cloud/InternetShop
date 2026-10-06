<?php
session_start();
require_once 'db.php';
require 'function.php';

$deleteCategory = deleteCategory($pdo, $_GET['id']);

if($deleteCategory){
    redirect('categories.php');
    exit;
}else{
    // $_SESSION['msg-error'] = 'Ошибка при удалении';
    redirect('categories.php');
    exit;
}