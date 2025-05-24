<?php
$current_page = basename($_SERVER['PHP_SELF']);
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
<body>
<div id="sidebar">
    <div id="adminpanel"><h2>ADMIN PANEL</h2></div><br>
    <ul>
        <li><a href="dashboard.php"><div class="<?= ($current_page == 'dashboard.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-gauge"></i>Dashboard</div></a></li>
        <li><a href="products.php"><div class="<?= ($current_page == 'products.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-cart-shopping"></i>All products</div></a></li>
        <li><a href="addproduct.php"><div class="<?= ($current_page == 'addproduct.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-plus"></i>Add product</div></a></li>
        <li><a href="categories.php"><div class="<?= ($current_page == 'categories.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-layer-group"></i>All categories</div></a></li>
        <li><a href="addcategory.php"><div class="<?= ($current_page == 'addcategory.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-plus"></i>Add category</div></a></li>
        <li><a href="orders.php"><div class="<?= ($current_page == 'orders.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-box"></i>Orders</div></a></li>
        <li><a href="customers.php"><div class="<?= ($current_page == 'customers.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-address-card"></i>Costumers</div></a></li>
        <li><a href="settings.php"><div class="<?= ($current_page == 'settings.php') ? 'active' : 'notselected' ?>"><i class="fa-solid fa-gear"></i>Settings</div></a></li>
    </ul>
</div>
</body>
</html>