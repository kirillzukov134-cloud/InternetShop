<?php
session_start();
require_once 'db.php';
//Редирект (переход по страницам)
function redirect($path)
{
    header("Location: $path");
    exit;
}


/*
Все что связано с пользователями и клиентами
*/


//Добавление пользователя
function insertUsers($pdo, $name, $email, $phone, $password, $role = 'User', $client_id = null, $is_blocked = 0)
{
    $sql = "INSERT INTO Users (name, email, phone, password, role, client_id, is_blocked) VALUES (:name, :email, :phone, :password, :role, :client_id, :is_blocked)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name'      => $name,
        ':email'     => $email,
        ':phone'     => $phone,
        ':password'  => $password,
        ':role'      => $role,
        ':client_id' => $client_id,
        ':is_blocked' => $is_blocked
    ]);
}

//Добавление клиента
function insertClients($pdo, $name, $email, $phone){
    $sql = "INSERT INTO Clients (name, email, phone) VALUES (:name, :email, :phone)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
    ]);
}

//Существует ли такой клиент? (Регистрация)
function CheckClientsReg($pdo, $email)
{
    $sql = "SELECT COUNT(1) FROM Clients WHERE email = :email";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':email' => $email
    ]);
    return $statement->fetchColumn() > 0;
}

//Существует ли такой клиент? (Авторизация)
function CheckClientAuth($pdo, $name, $password)
{
    $sql = "SELECT id, name, password, role, client_id, is_blocked FROM Users WHERE name = :name";
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

//Обновить клиентов
function updateClients($pdo, $client_id, $name, $email, $phone){
    $sql = "UPDATE Clients SET  name = :name, email = :email, phone = :phone WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':id' => $client_id
    ]);
}

// Топ-5 клиентов (Аналитика)
function byNumberOfClients($pdo){
    $sql = "SELECT 
	Clients.name AS Клиент,
    SUM(Orders.total_amount) AS Общая_сумма
FROM Orders
JOIN Clients ON Orders.client_id = Clients.id
WHERE Orders.total_amount > 0
GROUP BY Clients.name
LIMIT 5";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Обновить пользователей
function updateUsers($pdo, $user_id, $name, $email, $phone){
    $sql = "UPDATE Users SET  name = :name, email = :email, phone = :phone WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name,
        ':email' => $email,
        ':phone' => $phone,
        ':id' => $user_id
    ]);
}

//Обновить пользователя и клиента одновременно в update_user_logic.php
function updateUserAndClient($pdo, $user_id, $client_id, $name, $email, $phone){
    updateUsers($pdo, $user_id, $name, $email, $phone);
    updateClients($pdo, $client_id, $name, $email, $phone);
    return true;
}

//Все клиенты
function selectAllClients($pdo){
    $sql = "SELECT id, name, email, phone FROM Clients";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Все пользователи
function selectAllUsers($pdo){
    $sql = "SELECT id, name, is_blocked FROM Users";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Вывод пользователя по ID
function selectUserId($pdo, $id){
    $sql = "SELECT id, name, email, phone FROM Users WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => $id
    ]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

//Вывод клиента по ID
function getClientById($pdo, $id){
    $sql = "SELECT * FROM `Clients` WHERE id = :id";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':id' => $id
    ]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

//Поиск по имени
function filterationClientName($pdo, $name){
    $sql = 'SELECT Orders.id, 
                        Orders.client_id, 
                        Orders.created_at, 
                        Orders.total_amount, 
                        Orders.status, 
                        Clients.name AS client_name, 
                        Product.name AS product_name,
                        Order_position.quanitity
                FROM Orders 
                JOIN Clients ON Orders.client_id = Clients.id 
                JOIN Order_position ON Order_position.order_id = Orders.id 
                JOIN Product ON Product.id = Order_position.product_id
                WHERE Clients.name = :name';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':name' => $name
    ]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Время
function filterationClientTime($pdo, $time){
    $sql = 'SELECT Orders.id, 
                        Orders.client_id, 
                        Orders.created_at, 
                        Orders.total_amount, 
                        Orders.status, 
                        Clients.name AS client_name, 
                        Product.name AS product_name,
                        Order_position.quanitity
                FROM Orders 
                JOIN Clients ON Orders.client_id = Clients.id 
                JOIN Order_position ON Order_position.order_id = Orders.id 
                JOIN Product ON Product.id = Order_position.product_id
                WHERE Orders.created_at = :time';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':time' => $time
    ]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Блокировка пользователя
function blockedUser($pdo, $name){
    $sql = 'UPDATE `Users` SET `is_blocked`= 1 WHERE name = :name';
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':name' => $name
    ]);
}

//Разблокировка пользователя
function unblockUser($pdo, $id){
    $sql = 'UPDATE `Users` SET `is_blocked` = 0 WHERE id = :id';
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}

//Удалить клиента
function deleteClient($pdo, $id){
    $sql = "DELETE FROM Clients WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}


/*
Все что связано с продуктами (товары)
*/


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

//Редактирование продукта
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

//Удалить товар
function deleteProduct($pdo, $id){
    $sql = "DELETE FROM Product WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}

//Вывод продукта по ID
function getProductById($pdo, $id){
    $sql = "SELECT * FROM Product WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Вывод всех продуктов
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

//Товары с остатком > 0
function higherRemainingStock($pdo, $product_id){
    if(empty($product_id)){
        selectAllProduct($pdo);
    }else{
        $sql = 'SELECT
        Product.id,
        Product.name,
        Product.price,
        Product.remains,
        Product.category_id AS category_name
    FROM Product
    JOIN Product_category ON Product.category_id = Product_category.id
    WHERE Product.remains > 0';
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':product_id' => '%' .  $product_id . '%'
        ]);
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


/*
Все что связано с категориями
*/


//Добавление категорий
function insertCategory($pdo, $category){
    $sql = "INSERT INTO `Product_category`(`category`) VALUES (:category)";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':category' => $category
    ]);
}

//Вывод всех категорий
function selectAllCategory($pdo)
{
    $sql = "SELECT * FROM Product_category";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Удаление
function deleteCategory($pdo, $id){
    $sql = "DELETE FROM Product_category WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ':id' => $id
    ]);
}

//Поиск
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

//Подсчет выручки по каждой категории (Аналитика)
function revenueByCategory($pdo){
    $sql = "SELECT
    Product_category.category AS Категория,
    SUM(Order_position.quanitity * Order_position.purchase_at_price) AS Сумма
FROM Order_position
JOIN Product ON Order_position.product_id = Product.id 
JOIN Product_category ON Product.category_id = Product_category.id
JOIN Orders ON Order_position.order_id = Orders.id
WHERE Orders.status = 'Завершён'
GROUP BY Product_category.category";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


/*
Все что связано с заказами
*/


//Добавление заказа
function addOrder($pdo, $client_id){
    $sql = "INSERT INTO Orders (client_id, created_at, total_amount, status) VALUES (:client_id, NOW(), 0, 'Активный')";
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':client_id' => $client_id
    ]);
    return $pdo->lastInsertId();
}

//Вывод заказа по ID
function getOrderById($pdo, $id){
    $sql = "SELECT * FROM Orders WHERE id = :id LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id' => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Добавляет позицию в заказ
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

//Уменьшение остатка 
function descreaseRemainder($pdo, $product_id, $quantity){
    $sql = "UPDATE Product SET remains = remains - :quantity WHERE id = :id AND remains >= :quantity";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':quantity' => $quantity, 
        ':id' => $product_id
    ]);
}

//Обновление общей суммы заказа
function updateSumm($pdo, $order_id, $total_amount){
    $sql = "UPDATE Orders SET total_amount = :total_amount WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([
        ':total_amount' => $total_amount, 
        ':id' => $order_id
    ]);
}

//Возвращает заказы с именами клиентов (админ — все заказы, пользователь — только свои заказы)
function getOrdersAndClients($pdo){
    if ($_SESSION['user']['role'] === 'Admin') {
        $sql = "SELECT Orders.id, 
                        Orders.client_id, 
                        Orders.created_at, 
                        Orders.total_amount, 
                        Orders.status, 
                        Clients.name AS client_name, 
                        Product.name AS product_name,
                        Order_position.quanitity 
                FROM Orders 
                JOIN Clients ON Orders.client_id = Clients.id 
                JOIN Order_position ON Order_position.order_id = Orders.id 
                JOIN Product ON Product.id = Order_position.product_id";
        $statement = $pdo->query($sql);
    } else {
        $sql = "SELECT Orders.id, 
                        Orders.client_id, 
                        Orders.created_at, 
                        Orders.total_amount, 
                        Orders.status, 
                        Clients.name AS client_name, 
                        Product.name AS product_name,
                        Order_position.quanitity 
                FROM Orders 
                JOIN Clients ON Orders.client_id = Clients.id 
                JOIN Order_position ON Order_position.order_id = Orders.id 
                JOIN Product ON Product.id = Order_position.product_id
                WHERE Orders.client_id = :client_id";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            ':client_id' => $_SESSION['user']['client_id']
        ]);
    }
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}


//Фильтрация заказов по статусу
function filterationStatusOrder($pdo, $status){
    $sql = 'SELECT Orders.id, 
                    Orders.client_id, 
                    Orders.created_at, 
                    Orders.total_amount, 
                    Orders.status, 
                    Clients.name AS client_name, 
                    Product.name AS product_name,
                    Order_position.quanitity 
            FROM Orders 
            JOIN Clients ON Orders.client_id = Clients.id 
            JOIN Order_position ON Order_position.order_id = Orders.id 
            JOIN Product ON Product.id = Order_position.product_id
            WHERE Orders.status = :status';
    $statement = $pdo->prepare($sql);
    $statement->execute([
        ':status' => $status
    ]);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Менят статус заказа
function updateOrderStatus($pdo, $id, $status){
    $sql = "UPDATE `Orders` SET `status` = :status WHERE id = :id";
    $statement = $pdo->prepare($sql);
    return $statement->execute([
        ":status" => $status,
        ":id"     => $id
    ]);
}


/*
Аналитика
*/


//Общая выручка по завершённым заказам
function totalRevenueSumm($pdo){
    $sql = "SELECT
	COALESCE(SUM(Orders.total_amount), 0) AS Сумма
FROM Orders
WHERE Orders.status = 'Завершён'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Список товаров по количеству продаж
function byNumberOfUnitsSold($pdo){
    $sql = "SELECT
	Product.name
FROM Order_position
JOIN Product ON Order_position.product_id = Product.id 
JOIN Product_category ON Product.category_id = Product_category.id
JOIN Orders ON Order_position.order_id = Orders.id
WHERE Orders.status = 'Завершён'
GROUP BY Product.name";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Количество заказов по каждому статусу
function staticStatusOrders($pdo){
    $sql = 'SELECT 
    Orders.status AS Статус,
    COUNT(Orders.id) AS Всего_заказов
FROM Orders
JOIN Order_position ON Order_position.order_id = Orders.id
GROUP BY Order_position.quanitity, Orders.status';
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//Cредний чек по завершённым заказам
function AvgStatusCompleted($pdo){
    $sql = "SELECT 
    AVG(Orders.total_amount) AS Средний_чек
FROM Orders
WHERE Orders.status = 'Завершён'";
    $statement = $pdo->prepare($sql);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}