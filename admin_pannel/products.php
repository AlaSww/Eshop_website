<?php
    include("database.php");
    $sql="SELECT id,image_path,name,stock,price from product";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="pannel" >
    <script>
    function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
    }
    </script>
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <h1>Products Management</h1>
        <table>
            <thead>
                <tr>
                    <th >ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>category id</th>
                    <th>Stock</th>
                    <th>Price</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo "3asba";
                    }
                    else{
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){
                                echo '<tr>
                <td style="font-weight: bold;">
                '.htmlspecialchars($row["id"]).'
                </td>
                <td>
                <img src=../online_shop/'.$row['image_path'].' height="70px"></img>
                </td>
                <td>
                '.htmlspecialchars($row["name"]).'
                </td>
                <td>
                '.htmlspecialchars($row["category_id"]).'
                </td>
                <td>
                '.htmlspecialchars($row["stock"]).'
                </td>
                <td>
                '.htmlspecialchars($row["price"]).'
                TND</td>
                <td id="buttons">
                    <a href="" id="modifybutton"><i class="fa-solid fa-pen"></i><a>
                    <a id="deletebutton" onclick="return confirmDelete();" href="deleteproduct.php?id='.htmlspecialchars($row["id"]).'"><i  class="fa-solid fa-trash"></i><a>
                </td>
            </tr>';
                            }
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>