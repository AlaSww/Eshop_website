<?php include("header.php");?>
    <section class="hero">
      <div class="container">
        <div class="hero-content">
          <div class="hero-text">
            <h1 class="hero-title">New Gear <br>New Gains</h1>
            <p class="hero-description">Level up your training with our high-performance calisthenics equipment—engineered for strength, durability, and unbeatable results.</p>
            <div>
              <a href="products.php?page=1" class="btn btn-primary">Discover Products</a>
              <a href="cart.php" class="btn btn-secondary">Check Cart</a>
            </div>
          </div>
          <div class="hero-image">
            <img src="assets/hero.webp" alt="Fashion model showcase">
          </div>
        </div>
      </div>
    </section>

    <section class="categories">
      <div class="container">
        <h2 class="section-title">Shop by Category</h2>
        <div class="category-grid">
          <?php
            $i=0;
            $result=mysqli_query($conn,"SELECT * from category");
            if(mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                  if ($i >= 4) break; 
                  echo '<a href="products.php?category='.htmlspecialchars($row["id"]).'" class="category-item">
                  <img src="../admin_pannel/'.htmlspecialchars($row["image_path"]).'" alt='.htmlspecialchars($row["name"]).'>
                  <div class="category-overlay">
                    <h3 class="category-name">'.htmlspecialchars($row["name"]).'</h3>
                  </div>
                </a>';
                $i++;
                }
            }
          ?>
        </div>
      </div>
    </section>

    <section class="products">
      <div class="container">
        <div class="products-header">
          <h2 class="section-title">Recent Products</h2>
          <a href="products.php" class="view-all">View All</a>
        </div>
        <div class="product-grid">
        <?php
            $products=mysqli_query($conn,"SELECT * FROM product ORDER BY id DESC LIMIT 4 ");
            if($products && $products->num_rows>0){
              while($row=mysqli_fetch_assoc($products)){
                echo('<div class="product-card">
            <div class="product-image">
             <a href="product_details.php?id='.htmlspecialchars($row["id"]).'"> <img src="'.htmlspecialchars($row["image_path"]).'" alt="'.htmlspecialchars($row["name"]).'"></a>
                <a href="addtocart.php?product_id='.htmlspecialchars($row["id"]).'&quantity=1"><div class="add-to-cart">Add to Cart</div></a>
            </div>
            <div class="product-info">
              <h3 class="product-name">'.htmlspecialchars($row["name"]).'</h3>
              <div class="product-price">'.htmlspecialchars($row["price"]).'TND</div>
            </div>
          </div>');
              }
            }
          ?>
        </div>
      </div>
    </section>

    <section class="newsletter">
      <div class="container">
        <div class="newsletter-content">
          <h2 class="newsletter-title">Join Our Newsletter</h2>
          <p class="newsletter-description">Subscribe to get special offers, free giveaways, and once-in-a-lifetime deals.</p>
          <form class="newsletter-form">
            <input type="email" class="newsletter-input" placeholder="Your email address" required>
            <button type="submit" class="newsletter-button">Subscribe</button>
          </form>
        </div>
      </div>
    </section>

<?php include("footer.php")?>