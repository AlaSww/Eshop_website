<?php include("header.php")?>
<?php
    (int)$product_id=$_GET["id"];
    $product=getProductById($conn,$product_id);
?>
    <section class="product-detail">
      <div class="container">
        <div class="product-container">
          <div class="product-gallery">
            <div class="main-image">
              <img src="<?php echo $product["image_path"]?>" alt="Cotton Blend Sweater" id="main-product-image">
            </div>
          </div>
          
          <div class="product-info">
            <span class="product-category"><?php echo(getCategoryById($conn,$product["category_id"]))["name"];?></span>
            <h1 class="product-title"><?php echo $product["name"]?></h1>
            <div class="product-price">
              <span class="price-current"><?php echo $product["price"]?>TND</span>
            </div>
            
            <div class="product-rating">
              <div class="stars">
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">★</span>
                <span class="star">☆</span>
              </div>
              <span class="review-count">128 reviews</span>
            </div>
            
            <p class="product-description">
                <?php echo $product["description"]?>
            </p>
            
            <div class="quantity-selector">
              <button class="quantity-btn">-</button>
              <input type="number" class="quantity-input" value="1" min="1" max="10">
              <button class="quantity-btn">+</button>
            </div>
            
            <div class="product-actions">
              <a href="addtocart.php?id=<?=$_GET["id"]?>" class="btn btn-primary">Add to Cart</a>
              <button class="btn btn-secondary">Buy Now</button>
          </div>
        </div>
      </div>
    </section>

    <section class="products">
      <div class="container">
        <div class="products-header">
          <h2 class="section-title">You may also like</h2>
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

<?php include("footer.php")?>