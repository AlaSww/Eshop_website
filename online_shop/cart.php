<?php include("header.php"); $cart_id=$_SESSION["cart_id"]; ?>
<link rel="stylesheet" href="cart.css">
  <section class="page-header">
    <div class="container">
      <h1 class="page-title">Shopping Cart</h1>
      <p class="page-description">Review your items and checkout</p>
    </div>
  </section>

  <section class="cart-layout">
    <div class="container" >
      <!-- If cart has items -->
      <div class="cart-content" >
        <div class="cart-items">
          <div class="cart-header">
            <div class="cart-header-label">Product</div>
            <div class="cart-header-label">Price</div>
            <div class="cart-header-label">Quantity</div>
            <div class="cart-header-label">Total</div>
            <div></div>
          </div>

          <?php
            $items = mysqli_query($conn, "SELECT * FROM order_items where cart_id=$cart_id");
            $total_price=0;
            if ($items && mysqli_num_rows($items) > 0) {
              while ($row = mysqli_fetch_assoc($items)) {
                $total_price+=$row["price"];
                $product_id = $row['product_id'];
                $product = mysqli_query($conn, "SELECT * FROM product WHERE id=$product_id")->fetch_assoc();

                echo '<div class="cart-product">
                  <div class="product-info">
                    <div class="product-image">
                      <img src="'.htmlspecialchars($product["image_path"]).'" alt="' . htmlspecialchars($product["name"]) . '">
                    </div>
                    <div class="product-details">
                      <h3>' . htmlspecialchars($product["name"]) . '</h3>
                    </div>
                  </div>

                  <div class="product-price" data-title="Price:">TND ' . htmlspecialchars($product["price"]) . '</div>

                  <div class="product-quantity" data-title="Quantity:">
                    <button class="quantity-btn" onclick="decreaseValue(this)">-</button>
                    <input type="text" class="quantity-input" value="' . htmlspecialchars($row["quantity"]) . '" id="quantity" name="quantity" readonly>
                    <button class="quantity-btn" onclick="increaseValue(this)">+</button>
                  </div>

                  <div class="product-total" data-title="Total:">TND ' . htmlspecialchars($row["price"]). '</div>

                  <div class="remove-product">
                    <a href="removefromcart.php?product_id='.htmlspecialchars($product["id"]).'"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg></a>
                  </div>
                </div>';
              }
            }
          ?>

        <script>
          function increaseValue(button) {
            // Find the sibling input inside the same parent container
            const quantityInput = button.parentElement.querySelector('.quantity-input');
            let currentVal = parseInt(quantityInput.value);
            currentVal = isNaN(currentVal) ? 0 : currentVal;
            quantityInput.value = currentVal + 1;

            // Optionally, here you can add AJAX to send the new quantity to your server
          }

          function decreaseValue(button) {
            const quantityInput = button.parentElement.querySelector('.quantity-input');
            let currentVal = parseInt(quantityInput.value);
            currentVal = isNaN(currentVal) ? 1 : currentVal;
            if (currentVal > 1) {
                quantityInput.value = currentVal - 1;
                
                // Optionally send update to server here
            }
          }
        </script>


        <div class="cart-summary">
          <h2 class="summary-title">Order Summary</h2>

          <div class="summary-row">
            <span class="summary-label">Subtotal</span>
            <span class="summary-value">TND <?= $total_price?></span>
          </div>

          <div class="summary-row">
            <span class="summary-label">Shipping</span>
            <span class="summary-value">TND 8</span>
          </div>

          <div class="summary-row">
            <span class="summary-label">Tax</span>
            <span class="summary-value">TND 2</span>
          </div>

          <div class="summary-row summary-total">
            <span>Total</span>
            <span>TND <?= $total_price+10?></span>
          </div>

          <div class="promo-code">
            <div class="promo-title">Promo Code</div>
            <form class="promo-form">
              <input type="text" class="promo-input" placeholder="Enter code">
              <button type="button" class="promo-btn">Apply</button>
            </form>
          </div>

          <a href="order_process.php" class="checkout-btn">Proceed to Checkout</a>
        </div>
      </div>

      <div class="cart-actions">
        <a href="products.html" class="action-btn">Continue Shopping</a>
        <button class="action-btn">Update Cart</button>
      </div>

      <!-- If cart is empty (uncomment to show empty cart state)
      <div class="cart-empty">
        <div class="cart-empty-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
        </div>
        <h2 class="cart-empty-title">Your cart is empty</h2>
        <p class="cart-empty-message">Looks like you haven't made your choice yet.</p>
        <a href="products.html" class="cart-continue-btn">Continue Shopping</a>
      </div>
      -->
    </div>
  </section>

  <footer class="footer">
    <div class="container">
      <div class="footer-grid">
        <div class="footer-column">
          <h3>Shop</h3>
          <ul class="footer-links">
            <li><a href="#">Women</a></li>
            <li><a href="#">Men</a></li>
            <li><a href="#">Accessories</a></li>
            <li><a href="#">Home</a></li>
            <li><a href="#">Beauty</a></li>
            <li><a href="#">Sale</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Company</h3>
          <ul class="footer-links">
            <li><a href="#">About Us</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Store Locations</a></li>
            <li><a href="#">Our Responsibility</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Help</h3>
          <ul class="footer-links">
            <li><a href="#">Shipping & Returns</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
        </div>
        <div class="footer-column">
          <h3>Connect</h3>
          <div class="social-icons">
            <a href="#" aria-label="Facebook">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
            </a>
            <a href="#" aria-label="Instagram">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
            </a>
            <a href="#" aria-label="Twitter">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
            </a>
          </div>
        </div>
      </div>
      <div class="copyright">
        <p>&copy; 2025 ELEGANCE. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    // Simple JavaScript for the mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
      const navToggle = document.querySelector('.nav-toggle');
      const mainNav = document.querySelector('.main-nav');
      
      navToggle.addEventListener('click', function() {
        mainNav.classList.toggle('active');
      });
    });
  </script>
</body>
</html>
