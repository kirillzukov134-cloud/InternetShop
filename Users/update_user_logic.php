<?php
session_start();
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$user_id   = $_POST['id'];
$client_id = $_SESSION['user']['client_id'];

if(updateUserAndClient($pdo, $user_id, $client_id, $name, $email, $phone)){
    redirect('profile.php');
    exit;
}else{
    redirect('update_user_profile.php');
    exit;
}

