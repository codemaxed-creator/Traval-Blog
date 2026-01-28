<?php
include '../app/core/init.php';
// error_reporting(0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {

    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // confirm password check
    if ($password !== $confirm) {
        echo "<script>alert('❌ Password and Confirm Password do not match');</script>";
    } else {
        // hash password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ===== IMAGE UPLOAD SECTION =====
        $imageName = $_FILES['image']['name'];
        $imageTmp  = $_FILES['image']['tmp_name'];
        $imageFolder = '../uploads/' . basename($imageName);

        // make sure uploads folder exists
        if (!is_dir('../uploads')) {
            mkdir('../uploads', 0777, true);
        }

        if (move_uploaded_file($imageTmp, $imageFolder)) {
            // save image name in DB
            $query = "INSERT INTO users (username, email, password, image) 
                      VALUES ('$username', '$email', '$hashed_password', '$imageName')";
        } else {
            // image upload failed, still save user without image
           echo"  query not working";
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>
                alert('🎉 Successfully Signed Up!');
                window.location.href = 'login.php';
            </script>";
            exit;
        } else {
            echo "<script>alert('❌ Something went wrong: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Wanderlust</title>
    <link rel="stylesheet" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="signup-container">
        <div class="sign-box">
            <div class="signup-header">
                <h1>Wanderlust</h1>
                <p>Create your account and start your journey!</p>
            </div>

            <form class="login-form" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Full Name" name="username" required />
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Password" name="password" required />
                </div>
                <div class="form-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirm Password" name="confirm_password" required />
                </div>

                <!-- 🔥 New Image Upload Field -->
                <div class="form-group">
                    <i class="fas fa-image"></i>
                    <input type="file" name="image" accept="image/*" required />
                </div>

                <button type="submit" class="login-button" name="submit">Sign Up</button>
            </form>

            <div class="register-link">
                <p>Already have an account? <a href="login.php">Log In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
