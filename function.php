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

//Добавление продукта (product.php)
function insertProduct($pdo, $name, $price, $remains, $category_id){
    $sql = "INSERT INTO Product (name, price, remains, category_id) VALUES (:name, :price, :remains, :category_id)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':price' => $price,
        ':remains' => $remains,
        ':category_id' =>$category_id
    ]);
}

function insertCategory($pdo, $category){
    $sql = "INSERT INTO Product_category (category) VALUES (:category)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':category' => $category
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
    $sql = "SELECT id, name, password, role FROM Clients WHERE name = :name  LIMIT 1";
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

function selectAllProductID($pdo)
{
    $sql = "SELECT * FROM Product";
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

/*
Выводит все заказы пользователей (только Админа)
*/

function selectAllOrders($pdo){
    $sql = "SELECT
                Orders.id,
                Clients.name AS Клиент,
                Orders.created_at AS Дата_создания_заказа,
                Orders.total_amount AS Общая_сумма,
                Orders.status AS Статус
            FROM Orders
            JOIN Clients ON Orders.client_id = Clients.id";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function deleteProduct($pdo, $id){
    $sql = "DELETE FROM Product WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}


function deleteCategory($pdo, $id){
    $sql = "DELETE FROM Product_category WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}
