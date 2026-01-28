<?php
include '../app/core/init.php';

if (!isset($con)) {
    die("DB connection not found.");
}


if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid Destination ID'); window.location='?page=destinations';</script>";
    exit;
}

$id = (int)$_GET['id'];


$query = "SELECT * FROM destinations WHERE id = $id LIMIT 1";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Destination not found'); window.location='?page=destinations';</script>";
    exit;
}

$data = mysqli_fetch_assoc($result);


if (isset($_POST['update'])) {

    $title = mysqli_real_escape_string($con, trim($_POST['title']));
    $location = mysqli_real_escape_string($con, trim($_POST['location']));
    $type = mysqli_real_escape_string($con, trim($_POST['type']));
    $description = mysqli_real_escape_string($con, trim($_POST['description']));
    $old_image = $data['image'];
    $image = $old_image;

   
    if (!empty($_FILES['image']['name'])) {
        $img_name = time() . "_" . $_FILES['image']['name'];
        $img_tmp = $_FILES['image']['tmp_name'];
        $upload_path = "../uploads/" . $img_name;

        if (move_uploaded_file($img_tmp, $upload_path)) {

            // Remove old image if exists
            if (!empty($old_image) && file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }

            $image = $img_name;
        }
    }

    // --------------------------
    // 3.2 ⭐ Update Query
    // --------------------------
    $update = "
        UPDATE destinations 
        SET 
            title = '$title',
            location = '$location',
            type = '$type',
            description = '$description',
            image = '$image'
        WHERE id = $id
    ";

    if (mysqli_query($con, $update)) {
        echo "<script>alert('Destination Updated Successfully!'); window.location='?page=destinations';</script>";
        exit;
    } else {
        echo "<script>alert('Update Failed!');</script>";
    }
}
?>


<div class="container py-4">

    <h3 class="fw-bold mb-3">
        <i class="bi bi-pencil-square"></i> Edit Destination
    </h3>

    <div class="card shadow-sm">
        <div class="card-body">

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Title</label>
                    <input type="text" name="title" class="form-control"
                        value="<?= htmlspecialchars($data['title']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" class="form-control"
                        value="<?= htmlspecialchars($data['location']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Type</label>
                    <input type="text" name="type" class="form-control"
                        value="<?= htmlspecialchars($data['type']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($data['description']) ?></textarea>
                </div>

                <!-- OLD IMAGE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Current Image</label><br>

                    <?php if (!empty($data['image'])): ?>
                        <img src="../uploads/<?= $data['image'] ?>" style="width: 150px; border-radius: 10px;">
                    <?php else: ?>
                        <span class="text-muted">No Image</span>
                    <?php endif; ?>
                </div>

                <!-- NEW IMAGE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Upload New Image (optional)</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" name="update" class="btn btn-primary px-4">
                    Update Destination
                </button>

                <a href="?page=destinations" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>
</div>
