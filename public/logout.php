<?php
include '../app/core/init.php';
session_start(); // Session start karte hain

if (!empty($_SESSION['USER'])) {
    // Agar user session set hai, to usko unset/destroy karo
    unset($_SESSION['USER']);
    session_destroy();

    // ✅ Logout successful message + redirect
    echo "<script>
        alert('👋 You have been logged out successfully!');
        window.location.href = 'login.php';
    </script>";
    exit;
} else {
    // Agar koi session nahi mila (user pehle hi logout hai)
    echo "<script>
        alert('⚠️ You are not logged in!');
        window.location.href = 'login.php';
    </script>";
    exit;
}
?>
