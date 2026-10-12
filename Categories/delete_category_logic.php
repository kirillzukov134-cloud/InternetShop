<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$deleteCategory = deleteCategory($pdo, $_GET['id']);

if($deleteCategory){
    redirect('categories.php');
    exit;
}else{
    // $_SESSION['msg-error'] = 'Ошибка при удалении';
    redirect('categories.php');
    exit;
}