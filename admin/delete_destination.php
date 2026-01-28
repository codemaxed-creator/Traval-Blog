<?php
include '../app/core/init.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('Invalid destination ID!'); window.location='destination.php';</script>";
    exit;
}

$id = (int)$_GET['id'];

// 1️⃣ Image Delete — Pehle image naam fetch karo
$getImg = mysqli_query($con, "SELECT image FROM destinations WHERE id = $id");
$data = mysqli_fetch_assoc($getImg);

if ($data && $data['image']) {
    $imgPath = "../uploads/" . $data['image'];
    if (file_exists($imgPath)) {
        unlink($imgPath); // Delete image from folder
    }
}

// 2️⃣ Now Delete From Database
$delete = mysqli_query($con, "DELETE FROM destinations WHERE id = $id");

if ($delete) {
    echo "<script>alert('Destination deleted successfully!'); window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Failed to delete!'); window.location='destination.php';</script>";
}
