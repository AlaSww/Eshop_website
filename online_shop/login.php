<?php include("header.php"); ?>

<?php
session_start();
  $error = '';
  echo $_SESSION["id"];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cart_id = null;


    $statement = $conn->prepare("SELECT id, name, number, password FROM User WHERE email=?");
    $statement->bind_param('s', $email);
    $statement->execute();
    $statement->bind_result($id, $name, $number, $stored_password);

    if ($statement->fetch()) {
      $statement->close(); 

      try {

        $id = intval($id);

        $cart_stmt = $conn->prepare("SELECT id FROM cart WHERE user_id=?");
        $cart_stmt->bind_param('i', $id);
        $cart_stmt->execute();
        $cart_stmt->bind_result($cart_id);
        $cart_stmt->fetch();
        $cart_stmt->close(); 


        if (password_verify($password, $stored_password)) {
          $_SESSION["id"] = $id;
          $_SESSION["name"] = $name;
          $_SESSION["email"] = $email;
          $_SESSION["number"] = $number;
          $_SESSION["cart_id"] = $cart_id ?? null;

          header("Location: index.php");
          exit;
        } else {
          $error = "Invalid password";
        }
      } catch (mysqli_sql_exception $e) {
        $error = "Database error: " . $e->getMessage();
      }
    } else {
      $error = "Email not found";
    }
  }
?>

<main class="container">
  <div class="auth-container">
    <div class="auth-header">
      <h1 class="auth-title">Sign In</h1>
      <p class="auth-subtitle">Welcome back! Please enter your details</p>
    </div>

    <form method="POST">
      <?php if (!empty($error)): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
      <?php endif; ?>
      <div class="form-group">
        <label for="email" class="form-label">Email</label>
        <input type="email" id="email" name="email" class="form-input" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
      </div>
      <div class="form-options">
        <div class="form-checkbox">
          <input type="checkbox" id="remember">
          <label for="remember">Remember me</label>
        </div>
        <a href="#" class="forgot-password">Forgot password?</a>
      </div>
      <button type="submit" class="submit-button">Sign in</button>
    </form>
    
    <div class="auth-divider">
      <div class="auth-divider-line"></div>
      <span class="auth-divider-text">or</span>
      <div class="auth-divider-line"></div>
    </div>

    <div class="auth-footer">
      Don't have an account? <a href="register.php" class="auth-link">Sign up</a>
    </div>
  </div>
</main>

<?php include("footer.php"); ?>
