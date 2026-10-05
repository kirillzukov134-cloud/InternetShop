<?php
require_once 'db.php';
//Редирект (переход по страницам)
function redirect($path)
{
    header("Location: $path");
    exit;
}

//Добавление пользователя (регистрация)
function insertUsers($pdo, $name, $email, $phone, $password, $role = 'User')
{
    $sql = "INSERT INTO Clients (name, email, phone, password, role) VALUES (:name, :email, :phone, :password, :role)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':password' => $password,
        ':role' => $role
    ]);
}

//Существует ли такой клиент?
function CheckClientsReg($pdo, $email)
{
    $sql = "SELECT COUNT(1) FROM Clients WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':email' => $email
    ]);
    return $statement->fetchColumn() > 0;
}

function CheckClientAuth($pdo, $name, $password)
{
    $sql = "SELECT name, password, role FROM Clients WHERE name = :name  LIMIT 1";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':name' => $name,
    ]);
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    if ($users && password_verify($password, $users['password'])) {
        return $users;
    }
    return false;
}

/*
Все что связно с продуктами
*/
function selectAllProduct($pdo)
{
    $sql = "SELECT
                Product.id,
                Product.name,
                Product.price,
                Product.remains,
                Product_category.category AS category_name
            FROM Product
            JOIN Product_category ON Product.category_id = Product_category.id";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/*
Все что связно с категориями
*/

function selectAllCategory($pdo)
{
    $sql = "SELECT * FROM Product_category";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

/*
Все что связано с клиентами (пользователи)
*/

function selectAllUsers($pdo){
    $sql = "SELECT name, email, phone, role FROM Clients";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}