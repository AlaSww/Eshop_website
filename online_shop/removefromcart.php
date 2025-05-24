<?php
    session_start();
    require("database.php");
    $cart_id=$_SESSION["cart_id"];
    $product_id=$_GET["product_id"];
    echo $product_id;
    echo $cart_id;
    try{
        mysqli_query($conn,"DELETE from order_items where product_id=$product_id and cart_id=$cart_id");
    }
    catch(mysqli_sql_exception $e){
        $_SESSION['message'] = "❌ There was an error, please try again ❌";
    }
    $redirect_url = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    header("Location: $redirect_url");
    exit;
?>