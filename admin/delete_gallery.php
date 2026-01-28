<?php
include '../app/core/init.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // fetch image
    $query = mysqli_query($con, "SELECT image FROM gallery WHERE id='$id'");
    $row = mysqli_fetch_assoc($query);

    // delete file from folder
    $imagePath = "../uploads/gallery/" . $row['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    // delete record from DB
    mysqli_query($con, "DELETE FROM gallery WHERE id='$id'");

    header("Location: dashboard.php");
    exit();
}
?>
