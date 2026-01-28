<?php
include '../app/core/init.php';

if (!isset($_GET['id'])) {
    die("Invalid Request");
}

$id = (int)$_GET['id'];
$query = "SELECT * FROM destinations WHERE id = $id LIMIT 1";
$result = mysqli_query($con, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Destination Not Found!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($data['title']) ?> - Wanderlust</title>

    <style>
        /* RESET WHITE GAP */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            width: 100%;
            overflow-x: hidden;
            font-family: Arial, sans-serif;
        }

        /* FULL SCREEN HERO IMAGE */
        .details-header {
            width: 100%;
            height: 80vh;
            background-image: url("../uploads/<?= $data['image'] ?>");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }

        .details-header::after {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
        }

        .details-header h1 {
            font-size: 60px;
            font-weight: 800;
            z-index: 2;
        }

        /* CONTENT SECTION */
        .details-section {
            width: 85%;
            max-width: 900px;
            margin: 50px auto;
            animation: fadeUp 0.8s ease-in-out;
        }

        .details-meta {
            font-size: 18px;
            color: #ff7b00;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .details-desc {
            font-size: 18px;
            color: #444;
            line-height: 1.7;
            margin-bottom: 30px;
        }

        /* BACK BUTTON */
        .back-btn {
            display: inline-block;
            padding: 12px 25px;
            background: #ff7b00;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
            transition: 0.3s;
        }

        .back-btn:hover {
            background: #e56f00;
            transform: translateX(-5px);
        }

        /* Animation */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>

<!-- HERO BANNER IMAGE -->
<div class="details-header">
    <h1><?= htmlspecialchars($data['title']) ?></h1>
</div>

<!-- CONTENT -->
<section class="details-section">
    <div class="details-meta">🏷 Category: <?= htmlspecialchars($data['type']) ?></div>

    <p class="details-desc">
        <?= nl2br(htmlspecialchars($data['description'])) ?>
    </p>

    <a href="index.php" class="back-btn">⬅ Back to Home</a>
</section>

</body>
</html>
