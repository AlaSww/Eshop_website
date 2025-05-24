<?php
    require("database.php");
    $sql="SELECT * from category";
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="pannel" >
    <script>
    function confirmDelete() {
    return confirm("❌By deleting this category all it's products will be deleted❌");
    }
    </script>
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <h1 >Products Management</h1>
        <table>
            <thead>
                <tr>
                    <th >ID</th>
                    <th>Name</th>
                    <th>Number of products</th>
                    <th></th>
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
                            while($row = mysqli_fetch_assoc($result)) {
                                $nbr_result = mysqli_query($conn, "SELECT COUNT(*) as count FROM product WHERE category_id = {$row['id']}");
                                $count_row = mysqli_fetch_assoc($nbr_result);
                                $nbr_products = $count_row['count'];
                            
                                echo '<tr>
                                    <td style="font-weight: bold;">'.htmlspecialchars($row["id"]).'</td>
                                    <td>'.htmlspecialchars($row["name"]).'</td>
                                    <td>'.htmlspecialchars($nbr_products).'</td>
                                    <td>
                                        <a id="deletebutton" onclick="return confirmDelete();" href="deletecategory.php?id='.htmlspecialchars($row["id"]).'"><i class="fa-solid fa-trash"></i></a>
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