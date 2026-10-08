<?php
require_once 'db.php';
//Редирект (переход по страницам)
function redirect($path)
{
    header("Location: $path");
    exit;
}

//Добавление пользователя (регистрация)
function insertUsers($pdo, $name, $email, $phone, $password, $role = 'User', $client_id = null)
{
    $sql = "INSERT INTO Users (name, email, phone, password, role, client_id) VALUES (:name, :email, :phone, :password, :role, :client_id)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name'      => $name,
        ':email'     => $email,
        ':phone'     => $phone,
        ':password'  => $password,
        ':role'      => $role,
        ':client_id' => $client_id
    ]);
}

function insertClients($pdo, $name, $email, $phone){
    $sql = "INSERT INTO Clients (name, email, phone) VALUES (:name, :email, :phone)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
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
    $sql = "INSERT INTO `Product_category`(`category`) VALUES (:category)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':category' => $category
    ]);
}

function addOrder($pdo, $client_id){
    $sql = "INSERT INTO Orders (client_id, created_at, total_amount, status) VALUES (:client_id, NOW(), 0, 'Активный')";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':client_id' => $client_id
    ]);
    return $pdo->lastInsertId();
}

function getOrderById($pdo, $id){
    $sql = "SELECT * FROM Orders WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProductById($pdo, $id){
    $sql = "SELECT * FROM Product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getClientById($pdo, $id){
    $sql = "SELECT * FROM `Clients` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => $id
    ]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function addOrderPosition($pdo, $order_id, $product_id, $qty, $price){
    $sql = "INSERT INTO Order_position (order_id, product_id, quanitity, purchase_at_price) 
            VALUES (:oid, :pid, :qty, :price)";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':oid' => $order_id,
        ':pid' => $product_id,
        ':qty' => $qty,
        ':price' => $price
    ]);
}

function descreaseRemainder($pdo, $product_id, $quantity){
    $sql = "UPDATE Product SET remains = remains - :quantity WHERE id = :id AND remains >= :quantity";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':quantity' => $quantity, 
        ':id' => $product_id
    ]);
}

function updateSumm($pdo, $order_id, $total_amount){
    $sql = "UPDATE Orders SET total_amount = :total_amount WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':total_amount' => $total_amount, 
        ':id' => $order_id
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
    $sql = "SELECT id, name, password, role, client_id FROM Users WHERE name = :name";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':name' => $name
    ]);
    $users = $statement->fetch(PDO::FETCH_ASSOC);
    if ($users && password_verify($password, $users['password'])) {
        return $users;
    }
    return false;
}

function selectPrice($pdo, $product_id){
    $sql = 'SELECT price FROM Product WHERE id = :id';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => $product_id
    ]);
    return $statement->fetch(PDO::FETCH_ASSOC);
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

// function selectAllProductID($pdo)
// {
//     $sql = "SELECT * FROM Product";
//     $statement = $pdo->prepare($sql);
//     $statement->execute();
//     return $statement->fetchAll(PDO::FETCH_ASSOC);
// }

function filtrationCategory($pdo, $category_id) {
    if (empty($category_id)) {
        selectAllProduct($pdo);
    } else {
        $sql = 'SELECT 
                    Product.id, 
                    Product.name, 
                    Product.price, 
                    Product.remains,
                    Product_category.category AS category_name
                FROM Product
                JOIN Product_category ON Product.category_id = Product_category.id
                WHERE Product_category.category LIKE :category_id';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':category_id' => '%' .  $category_id . '%'
        ]);
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function filterationProduct($pdo, $product_id){
    if(empty($product_id)){
        selectAllProduct($pdo);
    }else{
        $sql = 'SELECT 
                    Product.id, 
                    Product.name, 
                    Product.price, 
                    Product.remains,
                    Product_category.category AS category_name
                FROM Product
                JOIN Product_category ON Product.category_id = Product_category.id
                WHERE LOWER(Product.name) LIKE LOWER(:product_id)';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':product_id' => '%' .  $product_id . '%'
        ]);
    }
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
Все что связано с клиентами и пользователями
*/

function selectAllClients($pdo){
    $sql = "SELECT id, name, email, phone FROM Clients";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function selectAllClient($pdo){
    $sql = "SELECT name FROM Clients";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function selectAllUsers($pdo){
    $sql = "SELECT id, name, email, phone, role FROM Users";
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

function updateOrderStatus($pdo, $id, $status){
    $sql = "UPDATE `Orders` SET `status` = :status WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ":status" => $status,
        ":id"     => $id
    ]);
}

function updateProduct($pdo, $id, $name, $price, $remains, $category_id){
    $sql = "UPDATE Product SET name = :name, price = :price, remains = :remains, category_id = :category_id WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':name' => $name,
        ':price' => $price,
        ':remains' => $remains,
        ':category_id' => $category_id,
        ':id' => $id
    ]);
}

function updateClients($pdo, $id, $name, $email, $phone){
    $sql = "UPDATE Clients SET name = :name, email = :email, phone = :phone WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':id' => $id
    ]);
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
