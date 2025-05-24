<?php
        if(isset($_FILES['image'])){
            $imagename = uniqid().basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'],'assets/'.$imagename);
            if (!move_uploaded_file($_FILES['image']['tmp_name'], 'assets/'.$imagename)) {
                echo "move failed";
            }
        }
        else{
            echo "b3iiid";
        }
        include("database.php");
        $name="test";
        $description="test";
        $price=5566.2;
        $stock=5;
        $category_id=5;
        $id=1;
        try{
            mysqli_query($conn,"UPDATE product SET name='$name' where id=$id;");
            mysqli_query($conn,"UPDATE product SET description='$description' where id=$id;");
            mysqli_query($conn,"UPDATE product SET price=$price where id=$id;");
            mysqli_query($conn,"UPDATE product SET category_id=$category_id where id=$id;");
            //mysqli_query($conn,"UPDATE product SET image_path=$'assets/$imagename' where id=$id;");
            mysqli_query($conn,"UPDATE product SET stock=$stock where id=$id;");
        }
        catch(mysqli_sql_exception){
            echo "FAILED TO MODIFY";
        }
?>