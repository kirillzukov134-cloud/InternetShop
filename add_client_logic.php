<?php
require_once 'db.php';
require 'function.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(insertClients($pdo, $name, $email, $phone)){
    redirect('clients.php');
    exit;
}else{
    redirect('add_client.php');
}