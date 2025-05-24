<?php
session_start();
require("database.php");
if(!$_SESSION["cart_id"]){
    header("location: login.php");
    exit;
}

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); 

$product_id = isset($_GET["product_id"]) ? (int) $_GET["product_id"] : 0;
$quantity = isset($_GET["quantity"]) ? (int) $_GET["quantity"] : 0;
$cart_id = isset($_SESSION["cart_id"]) ? (int) $_SESSION["cart_id"] : 0;

if (!$product_id || !$quantity || !$cart_id) {
    $_SESSION['message'] = "❌ Invalid product, quantity, or cart ❌";
    header("Location: index.php");
    exit;
}

$product = mysqli_query($conn, "SELECT * FROM product WHERE id=$product_id")->fetch_assoc();
$unit_price = $product['price'];
$result = mysqli_query($conn, "SELECT * FROM order_items WHERE product_id=$product_id AND cart_id=$cart_id");

if ($result && mysqli_num_rows($result)) {
    // Product exists, update quantity and price
    $query = "UPDATE order_items 
              SET quantity = quantity + $quantity, 
                  price = (quantity + $quantity) * $unit_price 
              WHERE product_id = $product_id AND cart_id = $cart_id";
} else {
    // New product
    $total_price = $unit_price * $quantity;
    $query = "INSERT INTO order_items (product_id, cart_id, quantity, price) 
              VALUES ($product_id, $cart_id, $quantity, $total_price)";
}

try {
    mysqli_query($conn, $query);
    $_SESSION['message'] = "✅ One product added successfully ✅";
} catch (mysqli_sql_exception $e) {
    $_SESSION['message'] = "❌ There was an error: " . $e->getMessage() . " ❌";
}

$redirect_url = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $redirect_url");
exit;
?>
