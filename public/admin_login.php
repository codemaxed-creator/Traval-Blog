<?php
// login.php - simple admin login (dev only)

// Start session
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// If already logged in, go to admin
if (isset($_SESSION['user'])) {
    if (!headers_sent()) {
        header('Location: ./admin.php');
        exit();
    } else {
        echo "<script>location='admin.php'</script>";
        exit();
    }
}

$message = '';

// Handle POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Simple check for empty
    if ($username === '' || $password === '') {
        $message = 'Please enter both username and password.';
    } else {
        // Hardcoded admin credentials (dev only)
        if ($username === 'max' && $password === 'max@123') {
            // Set session using lowercase key 'user'
            $_SESSION['user'] = [
                'username' => 'max',
                'role' => 'admin'
            ];

            // Redirect to admin.php
            if (!headers_sent()) {
                header('Location: admin.php');
                exit();
            } else {
                echo "<script>location='admin.php'</script>";
                exit();
            }
        } else {
            $message = 'Incorrect username or password.';
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <style>
    body{font-family:Arial,Helvetica,sans-serif;background:#f4f4f4;display:flex;align-items:center;justify-content:center;height:100vh;margin:0;}
    .box{background:#fff;padding:24px;border-radius:8px;box-shadow:0 4px 20px rgba(0,0,0,.08);width:320px}
    .box h2{margin:0 0 12px}
    .form-group{margin-bottom:12px}
    input[type=text],input[type=password]{width:100%;padding:8px;border:1px solid #ccc;border-radius:4px}
    button{width:100%;padding:10px;border:0;background:#007bff;color:#fff;border-radius:4px;cursor:pointer}
    .msg{color:#b00020;margin-bottom:10px}
    .note{margin-top:10px;font-size:13px;color:#666}
  </style>
</head>
<body>
  <div class="box">
    <h2>Admin Login</h2>

    <?php if ($message): ?>
      <div class="msg"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <form method="post" action="">
      <div class="form-group">
        <input type="text" name="username" placeholder="Username (e.g. max)" required>
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <a href="admin.php"><button type="submit">Log in</button></a>
    </form>

    <div class="note">Dev test credentials — username: <strong>max</strong>  password: <strong>max@123</strong></div>
  </div>
</body>
</html>
