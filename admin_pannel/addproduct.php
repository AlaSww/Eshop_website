<?php
    require("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin_pannel</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="pannel">
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <div class="container">
            <form action="addproduct.php" method="post" enctype="multipart/form-data">
                <h1>New Product</h1>
                <label for="name">name:</label>
                <input type="text" name="name" id="" required>
                <label for="description">description:</label>
                <textarea name="description" id="" required></textarea>
                <label for="price">price:</label>
                <input placeholder="0.00TND" type="number" step="0.001" name="price" id="" required>
                <label for="stock">stock:</label>
                <input placeholder="0" type="number" name="stock" id="" required>
                <label for="category">category:</label>
                <select id="choices" name="category">
                    <?php
                        $result=mysqli_query($conn,"SELECT * from category");
                        if($result && mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                                echo '<option value='.htmlspecialchars($row['id']).'>'.htmlspecialchars($row['name']).'</option>';
                            }
                        }
                    ?>
                </select></br>
                <label for="file"><div id="upload"><i class="fa-solid fa-upload"></i>Upload photo</div></label>
                <input type="file" name="image"id="file" required>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
        $maxsize = 2 * 1024 * 1024;
        if(isset($_FILES['image']) ){
            if($_FILES['image']['size']<= $maxsize){
                $imagename = uniqid().basename($_FILES['image']['name']);
                $path=  '/opt/lampp/htdocs/online_shop/assets/' . $imagename;
                if(move_uploaded_file($_FILES['image']['tmp_name'],$path)){
                    $sql=" INSERT INTO product(name,description,price,stock,image_path,category_id) values ('{$_POST["name"]}','{$_POST["description"]}',{$_POST["price"]},{$_POST["stock"]},'assets/$imagename',{$_POST["category"]})";
                    if(mysqli_query($conn,$sql)){
                        echo "<script type='text/javascript'>alert('Product saved successfully✅');</script>";
                    }
                    else{
                        echo "FAIlED TO SAVE!!";
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
?>