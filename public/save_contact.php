<?php
include '../app/core/init.php';

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages (name, email, subject, message)
        VALUES ('$name', '$email', '$subject', '$message')";

if(mysqli_query($con, $sql)){
    echo "<script>alert('Message Sent Successfully!'); window.location='index.php#contact';</script>";
} else {
    echo "Error: " . mysqli_error($con);
}
?>
