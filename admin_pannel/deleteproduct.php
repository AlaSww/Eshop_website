<?php
    include("database.php");
    $id=$_GET["id"];
    $sql="DELETE from product where id=$id";
    $result = mysqli_query($conn, "SELECT image_path FROM product WHERE id =$id");
    if ($row = mysqli_fetch_assoc($result)) {
        $imagePath = $row['image_path']; 
        $fullImagePath = realpath(__DIR__ . '/../online_shop/' . $imagePath);
    }
    if(file_exists($fullImagePath)){
        try{
            mysqli_query($conn,$sql);
            unlink($fullImagePath);
            header('Location: '."products.php");
        }
        catch(mysqli_sql_exception){
            echo "<script type='text/javascript'>alert('ERROR: try again later...');</script>";
        }
    }
    else{
        mysqli_query($conn,$sql);
        header('Location: '."products.php");
    }
?>