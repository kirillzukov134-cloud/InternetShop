<?php
require_once 'db.php';
require 'function.php';

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if(updateClients($pdo, $id, $name, $email, $phone)){
    redirect('clients.php');
    exit;
}else{
    redirect('update_client.php');
}
