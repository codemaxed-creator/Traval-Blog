<?php
include '../app/core/init.php';
session_start();





if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {

    $email =  $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($con, $query);
    
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {

            $_SESSION['USER'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];

            echo "<script>
                alert('🎉 Successfully Signed In!');
                window.location.href = 'index.php';
            </script>";
            exit;

        } else {
            echo "<script>alert('❌ Incorrect Password');</script>";
        }
    } else {
        echo "<script>alert('⚠️ Email not found');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wanderlust</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- <link rel="stylesheet" href="public/aassets/bootstrap/css/bootstrap.min.css"> -->
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Wanderlust</h1>
                <p>Welcome back, traveler!</p>
            </div>
            <form class="login-form" method="POST">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password"  name="password" required>
                </div>
                <div class="form-options">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" class="forgot-password">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Log In</button>


            </form>
            <!-- <div class="social-login">
                <p>Or login with</p>
                <div class="social-buttons">
                    <button class="social-btn google">
                        <i class="fab fa-google"></i> Google
                    </button>
                    <button class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </button>
                </div>
            </div>-->
            <div class="register-link"> 
                <p>Don't have an account? <a href="sign.php">Sign up</a></p>
            </div>
        
        </div>
    </div>
</body>
</html>