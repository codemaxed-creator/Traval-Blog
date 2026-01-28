<?php
include '../app/core/init.php'; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = md5($_POST['password']); // (Better: password_hash)
    $image = '';

    // 🖼 Upload image
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . '_' . basename($_FILES['image']['name']);
        $target = "../uploads/" . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $imageName;
        }
    }

    // 💾 Insert user
    $query = "INSERT INTO users (username, email, password, image, date)
              VALUES ('$username', '$email', '$password', '$image', NOW())";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo "<script>alert('✅ User added successfully!'); window.location='?page=users';</script>";
        exit;
    } else {
        echo "<script>alert('❌ Error adding user: " . mysqli_error($con) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New User</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Poppins', sans-serif;
      min-height: 100vh;
    }

    .card {
      border: 1px solid #e3e6ea;
      border-radius: 12px;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      overflow: hidden;
    }

    .card-header {
      background: #212529;
      color: #fff;
      font-weight: 600;
      padding: 1rem 1.5rem;
      font-size: 1.2rem;
      letter-spacing: 0.5px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .form-label {
      font-weight: 500;
      color: #333;
    }

    .form-control {
      border-radius: 10px;
      border: 1px solid #ccc;
      padding: 0.6rem;
      transition: all 0.2s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.15rem rgba(0,123,255,0.25);
    }

    .btn {
      border-radius: 10px;
      font-weight: 500;
    }

    .btn-primary {
      background: #007bff;
      border: none;
    }

    .btn-primary:hover {
      background: #0056b3;
    }

    .btn-secondary {
      background: #6c757d;
      border: none;
    }

    #previewImg {
      border-radius: 50%;
      border: 3px solid #e9ecef;
      margin-top: 10px;
      transition: 0.3s ease;
    }

    #previewImg:hover {
      transform: scale(1.05);
      border-color: #007bff;
    }

    .form-container {
      background: #fdfdfd;
      padding: 2rem;
    }

    .table-header-style {
      background: #212529;
      color: white;
      font-weight: bold;
      border-radius: 10px;
    }

  </style>
</head>

<body>
  <div class="container py-5">
    <div class="card mx-auto" style="max-width: 800px;">
      <div class="card-header">
        <i class="bi bi-person-plus"></i> Add New User
      </div>

      <div class="form-container">
        <form method="POST" enctype="multipart/form-data">
          <div class="row g-4">
            <div class="col-md-6">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" placeholder="Enter username" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter email address" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" placeholder="Enter password" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Profile Image</label>
              <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
            </div>

            <div class="col-12 text-center mt-4">
              <img id="previewImg" src="https://via.placeholder.com/120?text=Preview"
                   class="shadow-sm" width="120" height="120" style="object-fit: cover;">
            </div>

            <div class="col-12 d-flex justify-content-between mt-4">
              <button type="button" class="btn btn-secondary px-4" onclick="history.back()">
                <i class="bi bi-arrow-left"></i> Back
              </button>
              <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-check2"></i> Save User
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
      const [file] = e.target.files;
      if (file) document.getElementById('previewImg').src = URL.createObjectURL(file);
    });
  </script>
</body>
</html>
