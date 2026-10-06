<?php
session_start();
require_once 'db.php';
require 'function.php';

$category = $_POST['category'];

if(insertCategory($pdo, $category)){
    redirect('categories.php');
    exit;
}else{
    redirect('add_category.php');
    exit;
}