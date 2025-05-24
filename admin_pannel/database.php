<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecommerce";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    echo "failed to connect";
}
function getProductById($conn, $id) {
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" means integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the product row
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();  // return associative array of product
    } else {
        return null;  // no product found
    }
}
function getUserById($conn, $id) {
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM User WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" means integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the product row
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();  // return associative array of product
    } else {
        return null;  // no product found
    }
}
function getCategoryById($conn, $id) {
    // Prepare the statement
    $stmt = $conn->prepare("SELECT * FROM category WHERE id = ?");
    $stmt->bind_param("i", $id);  // "i" means integer parameter
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch the product row
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();  // return associative array of product
    } else {
        return null;  // no product found
    }
}
?>