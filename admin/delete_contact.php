<?php
include '../app/core/init.php';

// Check ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid Request!'); window.location='contact_messages.php';</script>";
    exit;
}

$id = intval($_GET['id']);

// Delete query
$sql = "DELETE FROM contact_messages WHERE id = $id";

if (mysqli_query($con, $sql)) {
    echo "<script>alert('Message Deleted Successfully!'); window.location='dashboard.php';</script>";
} else {
    echo "<script>alert('Failed to delete message!'); window.location='contact_messages.php';</script>";
}
?>
