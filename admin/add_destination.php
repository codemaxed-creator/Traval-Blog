<?php
// add_destination.php
include '../app/core/init.php';  // ❗ MUST INCLUDE DB CONNECTION

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // INPUT SAFE
    $title = mysqli_real_escape_string($con, trim($_POST['title']));
    $location = mysqli_real_escape_string($con, trim($_POST['location']));
    $type = mysqli_real_escape_string($con, trim($_POST['type']));
    $description = mysqli_real_escape_string($con, trim($_POST['description']));
    $image = '';

    // ---- IMAGE UPLOAD ----
    if (!empty($_FILES['image']['name'])) {

        $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', basename($_FILES['image']['name']));
        $target = "../uploads/" . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image = $imageName;
        }
    }

    // ---- INSERT INTO DATABASE ----
    $sql = "INSERT INTO destinations (title, location, type, description, image, date) 
            VALUES ('$title', '$location', '$type', '$description', '$image', NOW())";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('✅ Destination added successfully'); 
              window.location='?page=destinations';</script>";
        exit;
    } else {
        $error = mysqli_error($con);
    }
}
?>



<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container py-4">
  <div class="card mx-auto" style="max-width:800px;">
    <div class="card-header bg-dark text-white">
      <strong>Add Destination</strong>
    </div>
    <div class="card-body">
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?=htmlspecialchars($error)?></div>
      <?php endif; ?>

      <form method="POST" enctype="multipart/form-data">
        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Location</label>
            <input name="location" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Type (e.g. Island, Temple)</label>
            <input name="type" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" accept="image/*" id="imgInput">
          </div>

          <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4"></textarea>
          </div>

          <div class="col-12 text-center">
            <img id="preview" src="https://via.placeholder.com/300x160?text=Preview" style="max-width:320px; width:100%; height:auto; object-fit:cover;" class="img-fluid rounded shadow-sm">
          </div>

          <div class="col-12 d-flex justify-content-between">
            <a href="?page=destinations" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">Save Destination</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.getElementById('imgInput').addEventListener('change', function(e){
  const [f] = e.target.files;
  if (f) document.getElementById('preview').src = URL.createObjectURL(f);
});
</script>
    
</body>
</html>