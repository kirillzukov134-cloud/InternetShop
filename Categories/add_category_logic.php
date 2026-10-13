<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$category = $_POST['category'];

// var_dump($category);
// exit;

if(insertCategory($pdo, $category)){
    $_SESSION['msg-success'] = 'Успешное добавление';
    redirect('categories.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при добавлении';
    redirect('add_category.php');
    exit;
}