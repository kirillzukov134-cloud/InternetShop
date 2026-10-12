<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$category = $_POST['category'];

// var_dump($category);
// exit;

if(insertCategory($pdo, $category)){
    redirect('categories.php');
    exit;
}else{
    redirect('add_category.php');
    exit;
}