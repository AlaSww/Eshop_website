<?php
    require("database.php");
    $id=$_GET["id"];
    $result=mysqli_query($conn,"SELECT * from product where category_id=$id");
    try{
        mysqli_query($conn,"DELETE from category where id=$id");
        if(mysqli_num_rows($result)){
            while($row=mysqli_fetch_assoc($result)){
                $path= realpath(__DIR__ . '/../online_shop/' . $row["image_path"]);
                unlink($path);
            }
        }
        header('location: '."categories.php");
    }
    catch (mysqli_sql_exception){
        echo "<script type='text/javascript'>alert('ERROR: try again later...');</script>";
        header('location: '."categories.php");
    }
?>