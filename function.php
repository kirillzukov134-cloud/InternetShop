<?php
require_once 'db.php';
//Редирект (переход по страницам)
function redirect($path){
    header("Location: $path");
    exit;
}

//Добавление пользователя (регистрация)
function insertUsers($pdo, $name, $email, $phone, $password){
    $sql = "INSERT INTO Clients (name, email, phone, password) VALUES (:name, :email, :phone, :password)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':password' => $password
    ]);
}

//Существует ли такой клиент?
function CheckClientsReg($pdo, $email){
    $sql = "SELECT COUNT(1) FROM Clients WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':email' => $email
    ]);
    return $statement->fetchColumn() > 0;
}

function CheckClientAuth($pdo, $name, $password){
    $sql = "SELECT name, password FROM Clients WHERE name = :name  LIMIT 1";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':name' => $name,
    ]);
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    if ($users && password_verify($password, $users['password'])) {
        $_SESSION['user_id'] = $users['id'];
        $_SESSION['user_name'] = $users['name'];
        return true;
    }
return false;        
}