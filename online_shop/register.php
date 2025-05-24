<?php
include("header.php");
session_start();
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmation = $_POST['confirmation'];

    $already = mysqli_query($conn, "SELECT * FROM User WHERE email = '$email'");
    if (mysqli_num_rows($already) > 0) {
        $error = "Email already exists";
    } elseif (strlen($password) < 8) {
        $error = "Password must contain at least 8 characters";
    } elseif ($password !== $confirmation) {
        $error = "Password does not match";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $conn->prepare("INSERT INTO User(name, email, number, password) VALUES (?, ?, ?, ?)");
        $statement_forcart = $conn->prepare("INSERT INTO cart(user_id) VALUES (?)");

        $statement->bind_param('ssis', $name, $email, $number, $hash);
        $statement->execute();
        $insert_id = $statement->insert_id;

        $statement_forcart->bind_param('i', $insert_id);
        $statement_forcart->execute();
        $insert_cart_id = $statement_forcart->insert_id;

        $statement->close();
        $statement_forcart->close();

        $_SESSION["id"] = $insert_id;
        $_SESSION["cart_id"] = $insert_cart_id;
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["number"] = $number;

        header("Location: index.php");
        exit;
    }
}
?>

<main class="container">
  <div class="auth-container">
    <div class="auth-header">
      <h1 class="auth-title">Register</h1>
      <p class="auth-subtitle">Welcome! Please enter your details</p>
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
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-input" placeholder="Enter your name" required>
      </div>
      <div class="form-group">
        <label for="number" class="form-label">Phone Number</label>
        <input type="number" id="number" name="number" class="form-input" placeholder="Enter your phone number" required>
      </div>
      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input type="password" id="password" name="password" class="form-input" placeholder="••••••••" required>
      </div>
      <div class="form-group">
        <label for="confirmation" class="form-label">Confirmation</label>
        <input type="password" id="confirmation" name="confirmation" class="form-input" placeholder="••••••••" required>
      </div>

      <div class="form-options">
        <div class="form-checkbox">
          <input type="checkbox" id="remember">
          <label for="remember">Remember me</label>
        </div>
        <a href="#" class="forgot-password">Forgot password?</a>
      </div>

      <button type="submit" class="submit-button">Register</button>
    </form>

    <div class="auth-divider">
      <div class="auth-divider-line"></div>
      <span class="auth-divider-text">or</span>
      <div class="auth-divider-line"></div>
    </div>

    <div class="auth-footer">
      Already have an account? <a href="login.php" class="auth-link">Login</a>
    </div>
  </div>
</main>

<?php include("footer.php"); ?>
