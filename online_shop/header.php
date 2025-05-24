<?php
    require("database.php");
    session_start();
    $authenticated=false;
    if(isset($_SESSION["email"])){
      $authenticated=true;
    }
    if (isset($_SESSION['message'])) {
      echo "<script>alert('" . addslashes($_SESSION['message']) . "');</script>";
      unset($_SESSION['message']);
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RI9 SHOP</title>
    <meta name="description" content="RI9 Store" />
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/5/w3.css">
  </head>

  <body>
    <header>
      <div class="container">
        <div class="header-content">
          <button class="nav-toggle" aria-label="Toggle menu">☰</button>
          <a href="index.php"><div class="logo">RI9 SHOP</div></a>
          <nav class="main-nav">
            <ul>
              <?php
                    $result=mysqli_query($conn,"SELECT * from category");
                    if(mysqli_num_rows($result)>0){
                        while($row=mysqli_fetch_assoc($result)){
                            echo '<li><a href="products.php?category='.htmlspecialchars($row["id"]).'">'.htmlspecialchars($row["name"]).'</a></li>';
                        }
                    }
              ?>
            </ul>
          </nav>
            <form action="products.php" method="GET" class="search-container">
              <input type="text" placeholder="Search anything..." name="sp">
              <button class="search-button" type="submit">
              <i class="fa fa-search"></i>
              </button>
            </form>
          <div class="header-icons">
            <?php if($authenticated){?>
            <a href="cart.php" aria-label="Shopping cart">
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path><line x1="3" y1="6" x2="21" y2="6"></line><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
            </a>
            <a href="logout.php" aria-label="Shopping cart">
              Logout
            </a>
            <?php } else{?>
              <a href="login.php" aria-label="Shopping cart">
              Login
              </a>
              <a href="register.php" aria-label="Shopping cart">
              Register
              </a>
            <?php }?>
          </div>
        </div>
      </div>
    </header>