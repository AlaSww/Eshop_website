<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pannel" >
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <div class="categorycontainer">
            <h2>Add New Category</h2>
            <form id="categoryForm" action="addcategory.php" method="POST" enctype="multipart/form-data">
                <label for="categoryname">Category Name:</label>
                <input type="text" id="categoryname" name="categoryname" required />
                <label for="file"><div id="upload"><i class="fa-solid fa-upload"></i>Upload photo</div></label>
                <input type="file" name="image" id="file" required>
                <button type="submit" id="addbutton">submit</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include("database.php");
        $name=$_POST["categoryname"];
        echo $name;
        $exists = mysqli_query($conn, "SELECT * from category where name='$name'");
        if(mysqli_num_rows($exists)>0){
            echo "<script type='text/javascript'>alert('$name already exists');</script>";
        }
        else{
            $maxsize = 2 * 1024 * 1024;
            if(isset($_FILES['image']) ){
                if($_FILES['image']['size']<= $maxsize){
                    $imagename = uniqid().basename($_FILES['image']['name']);
                    $path=  'categories_photos/' . $imagename;
                    if(move_uploaded_file($_FILES['image']['tmp_name'],$path) ){
                        $sql="INSERT INTO category(name,image_path) values ('$name','$path')";
                        try{
                            mysqli_query($conn,$sql);
                            echo "<script type='text/javascript'>alert('category saved successfully✅');</script>";
                        }
                        catch(mysqli_sql_exception $e){
                            echo $e;
                            unlink($path);
                        }
                    }
                    }
                    else{
                        echo "<script type='text/javascript'>alert('FAILED TO UPLOAD THE IMAGE!!');</script>";
                    }
                }
                else{
                    echo "<script type='text/javascript'>alert('THE IMAGE MUST BE UNDER 2MB!!');</script>";
                }
            }
        }
?>