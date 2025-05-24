<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "ecommerce";

$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

if (!$conn) {
    die ("failed to connect to database");
}
function getProductById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM product WHERE id = ?");
    $stmt->bind_param("i", $id);  
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); 
    } else {
        return null; 
    }
}
function getCategoryById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM category WHERE id = ?");
    $stmt->bind_param("i", $id);  
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc(); 
    } else {
        return null;  
    }
}

?>