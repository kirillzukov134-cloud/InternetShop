<?php
session_start();
require_once __DIR__ . '/../db.php';
require __DIR__ . '/../function.php';

$id = $_GET['id'];

if(unblockUser($pdo, $id)){
    $_SESSION['msg-success'] = 'Успешно разблокировано';
    redirect('users.php');
    exit;
}else{
    $_SESSION['msg-error'] = 'Ошибка!';
    redirect('users.php');
    exit;
}

