<?php
// Simple PHP Admin Login Page

session_start();

// Correct credentials
$correct_username = 'max'; 
$correct_password = 'max@123';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username === $correct_username && $password === $correct_password) {
        $_SESSION['admin'] = $username;
        header('Location: dashboard.php'); // Redirect after successful login
        exit;
    } else {
        $message = 'Incorrect username or password';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Admin Login</title>
  <style>
    :root{--bg:#f4f7fb;--card:#ffffff;--accent:#2563eb}
    *{box-sizing:border-box}
    body{margin:0;font-family:Inter,system-ui,Segoe UI,Roboto,Helvetica,Arial;display:grid;place-items:center;height:100vh;background:linear-gradient(180deg,var(--bg),#e9eef8)}
    .card{width:360px;background:var(--card);padding:28px;border-radius:12px;box-shadow:0 8px 30px rgba(20,30,60,0.08)}
    h1{margin:0 0 12px;font-size:20px;color:#0f172a}
    p.sub{margin:0 0 20px;color:#475569;font-size:13px}
    label{display:block;font-size:13px;color:#334155;margin-bottom:6px}
    input[type="text"],input[type="password"]{width:100%;padding:10px 12px;border:1px solid #e6eef8;border-radius:8px;font-size:14px}
    .row{margin-bottom:14px}
    .actions{display:flex;gap:8px;align-items:center}
    button{flex:1;padding:10px 12px;border-radius:10px;border:0;background:var(--accent);color:#fff;font-weight:600;cursor:pointer}
    .note{font-size:12px;color:#64748b}
    .error{color:#b91c1c;margin-top:8px;font-size:13px}
  </style>
</head>
<body>
  <main class="card" role="main">
    <h1>Admin Login</h1>
    <p class="sub">Sign in with your administrator account.</p>

    <form method="post" autocomplete="off">
      <div class="row">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : 'max'; ?>" />
      </div>

      <div class="row">
        <label for="password">Password</label>
        <input id="password" name="password" type="password" required />
      </div>

      <div class="row actions">
        <button type="submit">Sign in</button>
      </div>

      <?php if ($message): ?>
        <p class="error"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>

      <p class="note">This is a simple demo. In real applications, use password hashing and secure sessions.</p>
    </form>
  </main>
</body>
</html>
