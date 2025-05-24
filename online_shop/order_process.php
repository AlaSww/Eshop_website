<?php include("header.php")?>
<?php
    $name=$_SESSION["name"];
    $email=$_SESSION["email"];
    $number=$_SESSION["number"];
    $cart_id=(int)$_SESSION["cart_id"];
?>
  <main class="container">
    <div class="order-container">
      <div>
        <div class="order-section">
          <h2 class="section-title">Shipping Information</h2>
          <form method="POST">
            <div class="form-row">
              <div class="form-group">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" class="form-input" value="<?= $name?>" name="name" required>
              </div>
            </div>

            <div class="form-group">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" class="form-input" value="<?= $email?>" name="email" required>
            </div>

            <div class="form-group">
              <label for="phone" class="form-label">Phone Number</label>
              <input type="tel" id="phone" class="form-input" value="+216 <?= $number?>" name="number" required>
            </div>

            <div class="form-group">
              <label for="address" class="form-label">Street Address</label>
              <input type="text" id="address" class="form-input" placeholder="123 Main Street" name="street" required>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label for="city" class="form-label">City</label>
                <input type="text" id="city" class="form-input" name="city" required>
              </div>
              <div class="form-group">
                <label for="state" class="form-label">State/Province</label>
                <select id="state" class="form-select" name="state" required>
                <option value="ARI">Ariana</option>
                <option value="BEJ">Beja</option>
                <option value="BEN">Benzart</option>
                <option value="BIZ">Bizerte</option>
                <option value="GAF">Gafsa</option>
                <option value="JEN">Jendouba</option>
                <option value="KAI">Kairouan</option>
                <option value="KAS">Kasserine</option>
                <option value="KEB">Kebili</option>
                <option value="KEF">Kef</option>
                <option value="MAH">Mahdia</option>
                <option value="MED">Medenine</option>
                <option value="MON">Monastir</option>
                <option value="NAB">Nabeul</option>
                <option value="SFAX">Sfax</option>
                <option value="SIDI">Sidi Bouzid</option>
                <option value="SIL">Siliana</option>
                <option value="SUS">Sousse</option>
                <option value="TAT">Tataouine</option>
                <option value="TOU">Tozeur</option>
                <option value="TUN">Tunis</option>
                <option value="ZAG">Zaghouan</option>
                </select>
              </div>
              <div class="form-group">
                <label for="zip" class="form-label">ZIP/Postal Code</label>
                <input type="text" id="zip" class="form-input" placeholder="10001" required>
              </div>
            </div>

            <div class="form-group">
              <label for="notes" class="form-label">Delivery Notes</label>
              <textarea id="notes" class="form-textarea" placeholder="Special delivery instructions or notes (optional)"></textarea>
            </div>
            <button type="submit" class="submit-button">Complete Order</button>
          </form>
        </div>
      </div>

      <div class="order-summary order-section">
        <h2 class="section-title">Order Summary</h2>
        
        <div class="cart-items">
            <?php
                $items = mysqli_query($conn, "SELECT * FROM order_items where cart_id=$cart_id");
                $total_price=0;
                if ($items && mysqli_num_rows($items) > 0) {
                while ($row = mysqli_fetch_assoc($items)) {
                    $total_price+=$row["price"];
                    $product_id = $row['product_id'];
                    $product = mysqli_query($conn, "SELECT * FROM product WHERE id=$product_id")->fetch_assoc();
                    echo '<div class="cart-item">
                <img src="'.htmlspecialchars($product["image_path"]).'" alt="Classic White Shirt" class="cart-item-image">
                <div class="cart-item-details">
                <h3 class="cart-item-title">'.htmlspecialchars($product["name"]).'</h3>
                </div>
                <div class="cart-item-price">TND '.htmlspecialchars($row["price"]).'</div>
            </div>';
                }
                }
            ?>
        </div>

        <div class="summary-calculations">
          <div class="summary-row">
            <div>Subtotal</div>
            <div>TND <?= $total_price?></div>
          </div>
          <div class="summary-row">
            <div>Shipping</div>
            <div>TND 8</div>
          </div>
          <div class="summary-row">
            <div>Tax</div>
            <div>TND 2</div>
          </div>
          <div class="summary-row total">
            <div>Total</div>
            <div>TND <?= $total_price+10?></div>
          </div>
        </div>

      </div>
    </div>
  </main>

<?php include("footer.php")?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $city = $_POST["city"];
    $street = $_POST["street"]; 
    $number = $_POST["number"];
    $email = $_POST["email"];
    $state = $_POST["state"];
    $cart_id = (int)$_SESSION["cart_id"];
    $user_id = (int)$_SESSION["id"];
    $location = $state . '/' . $city . '/' . $street;

    $total_price = 0;
    $items = mysqli_query($conn, "SELECT price FROM order_items WHERE cart_id=$cart_id");
    if ($items) {
        while ($row = mysqli_fetch_assoc($items)) {
            $total_price += $row["price"];
        }
    }

    try {
        $statement = $conn->prepare("INSERT INTO orders (user_id, total, location, number) VALUES (?, ?, ?, ?)");
        $statement->bind_param("iisi", $user_id, $total_price, $location, $number);
        $statement->execute();

        $insert_id = $statement->insert_id;
        $statement->close();

        $update_items = $conn->prepare("UPDATE order_items SET order_id = ?, cart_id = NULL WHERE cart_id = ?");
        $update_items->bind_param("ii", $insert_id, $cart_id);
        $update_items->execute();
        $update_items->close();

        echo "Order placed successfully!";
    } catch (mysqli_sql_exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
