<?php
include '../app/core/init.php';

if(isset($_POST['submit'])){
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../uploads/gallery/" . $image);

    $sql = "INSERT INTO gallery(image) VALUES('$image')";
    mysqli_query($con, $sql);

    echo "<script>alert('Gallery Image Added!');</script>";
}
?>

<style>
    .gallery-form-container {
        max-width: 450px;
        margin: 40px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 0px 15px rgba(0,0,0,0.12);
        font-family: Arial, sans-serif;
    }

    .gallery-form-container h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 22px;
        font-weight: bold;
        color: #333;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 15px;
    }

    .btn-submit {
        width: 100%;
        background: #007bff;
        padding: 12px;
        border-radius: 8px;
        border: none;
        font-size: 16px;
        color: white;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        background: #0056b3;
    }
</style>

<div class="gallery-form-container">
    <h2>Add Gallery Image</h2>

    <form method="POST" enctype="multipart/form-data">
        <label class="form-label">Select Image:</label>
        <input type="file" name="image" class="form-control" required>

        <button type="submit" name="submit" class="btn-submit">Upload Image</button>
    </form>
</div>

