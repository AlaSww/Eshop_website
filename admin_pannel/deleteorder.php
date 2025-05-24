<?php
    include("database.php");
    $id=$_GET["id"];
    $sql="DELETE from orders where id=$id";
    try{
        mysqli_query($conn,$sql);
        header('Location: '."orders.php");
        exit;
    }
    catch(mysqli_sql_exception){
        echo "<script type='text/javascript'>alert('ERROR: try again later...');</script>";
    }
?>