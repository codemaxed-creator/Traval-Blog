<?php
include '../app/core/init.php'; // DB connection include

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $query = "SELECT image FROM users WHERE id = $id";
    $result = mysqli_query($con, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $imagePath = "../uploads/" . $user['image'];

        // अगर image exist करती है तो delete कर दो
        if (!empty($user['image']) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        // 🔹 अब database से user delete कर दो
        $deleteQuery = "DELETE FROM users WHERE id = $id";
        mysqli_query($con, $deleteQuery);
    }

    // 🔹 वापस users list पर redirect कर दो
    header("Location: dashboard.php");
    exit;
} else {
    echo "Invalid request!";
}
?>
