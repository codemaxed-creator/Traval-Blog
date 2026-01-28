

<?php

include '../app/core/init.php';


// 🧠 Fetch user
if (!isset($_GET['id'])) {
    echo "<script>alert('User ID missing!'); window.location='all_user.php';</script>";
    exit;
}

$id = (int)$_GET['id'];
$result = mysqli_query($con, "SELECT * FROM users WHERE id = $id");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>alert('User not found!'); window.location='all_user.php';</script>";
    exit;
}

// 🧩 Update Logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $image = $user['image'];

    if ($password !== $confirm_password) {
        echo "<script>alert('❌ Passwords do not match!');</script>";
    } else {
        $updatePassword = '';
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $updatePassword = ", password='$hashed'";
        }

        // 🖼 Image upload
        if (!empty($_FILES['image']['name'])) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $targetPath = "../uploads/" . $imageName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                if (!empty($image) && file_exists("../uploads/" . $image)) {
                    unlink("../uploads/" . $image);
                }
                $image = $imageName;
            }
        }

        $query = "UPDATE users SET username='$username', email='$email', image='$image' $updatePassword WHERE id=$id";
        if (mysqli_query($con, $query)) {
           echo "<script>alert('User updated successfully!'); window.location='edit_user.php?id=$id';</script>";

            exit;
        } else {
            echo "<script>alert('❌ Error: " . mysqli_error($con) . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Edit User</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .edit-wrapper {
      max-width: 700px;
      margin: 50px auto;
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }
    img.rounded-circle {
      object-fit: cover;
    }
  </style>
</head>
<body>
   <div class="mb-3">
          <label class="form-label">Profile Image</label>
          <input type="file" name="image" class="form-control" accept="image/*">
        </div>

  <div class="container">
    <div class="edit-wrapper">
      <h3 class="fw-bold mb-4 text-center">Edit User</h3>

      <form method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
          </div>
          <div class="col-md-6">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="confirm_password" class="form-control">
          </div>
        </div>

       

        <?php if (!empty($user['image'])): ?>
          <div class="text-center mb-3">
            <img src="../uploads/<?= htmlspecialchars($user['image']) ?>" width="120" height="120" class="rounded-circle shadow-sm">
            <p class="text-muted mt-2">Current Profile Image</p>
          </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between">
       <button type="button" class="btn btn-secondary" onclick="history.back()">
  <i class="bi bi-arrow-left"></i> Cancel
</button>
          
          <button type="submit" class="btn btn-primary" onclick="history.back()" >
            <i class="bi bi-check2"></i> Update User
          </button>
          
 
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
