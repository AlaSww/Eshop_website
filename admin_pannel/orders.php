<?php require("database.php")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="pannel" >
    <div class="sidebarcontainer">
        <?php include 'sidebar.php'; ?>
    </div>
    <div id="content">
        <h1>Orders management</h1>
        <table  class="data-table">
            <thead>
                <tr>
                    <th >ID</th>
                    <th>User</th>
                    <th>Phone number</th>
                    <th>Location</th>
                    <th>Items</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT * from orders";
                    $result = mysqli_query($conn, $sql);
                    if(!$result){
                        echo "3asba";
                    }
                    else{
                        while($row=mysqli_fetch_assoc($result)){
                            $id=$row["id"];
                            $user_id=$row["user_id"];
                            $user=getUserById($conn,$user_id);
                            $items=mysqli_query($conn,"SELECT * from order_items where order_id=$id");
                            $user_name=$user["name"];
                            $phone_number=$user["number"];
                            echo '<tr>
    <td style="font-weight: bold;">' . htmlspecialchars($row["id"]) . '</td>
    <td>' . htmlspecialchars($user_name) . '</td>
    <td>' . htmlspecialchars($phone_number) . '</td>
    <td>' . htmlspecialchars($row["location"]) . '</td>
    <td>';
while ($item = mysqli_fetch_assoc($items)) {
    $product = getProductById($conn, $item["product_id"]);
    echo htmlspecialchars($product["name"]) . ' * ' . htmlspecialchars($item["quantity"]) . '<br>';
}
echo '</td>
    <td>
        <a id="deletebutton" onclick="return confirmDelete();" href="deleteorder.php?id=' . htmlspecialchars($row["id"]) . '"><i class="fa-solid fa-trash"></i></a>
    </td>
    <td>';
if ($row["state"] == "PENDING") {
    echo '<a id="modifybutton" href="confirmorder.php?id=' . htmlspecialchars($row["id"]) . '">CONFIRM</a>';
} else {
    echo '<span style="color: black;">CONFIRMED</span>';
}
echo '
    </td>
</tr>';
                            
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script>
    function confirmDelete() {
    return confirm("Are you sure you want to delete this item?");
    }
    </script>
</body>
</html>