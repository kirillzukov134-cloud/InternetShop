<?php
session_start();
require_once 'db.php';
require 'function.php';

$id = $_GET['id'];
$deleteClient = deleteClient($pdo, $id);

if($deleteClient){
    redirect('clients.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка при удалении';
    redirect('clients.php');
    exit;
}