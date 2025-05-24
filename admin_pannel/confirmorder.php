<?php
    $id = $_GET["id"];
    include("database.php");
    $sql = "UPDATE orders SET state='CONFIRMED' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        header("location: order.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($conn); 
        exit;
    }
?>