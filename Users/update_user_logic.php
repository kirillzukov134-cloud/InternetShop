<?php
session_start();
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];


$update = updateClients($pdo, $id, $name, $email, $phone);
if($update){

    redirect('profile.php');
    exit;
}else{
    redirect('update_user_profile.php');
    exit;
}

