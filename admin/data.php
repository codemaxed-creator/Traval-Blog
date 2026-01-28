<?php
include '../app/core/init.php';

// Destination count
// Destination count
$destQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM destinations");
$destData = mysqli_fetch_assoc($destQuery);
$destCount = $destData['total'];

?>
<?php
$gallery_q = mysqli_query($con, "SELECT COUNT(*) AS total FROM gallery");
$gallery = mysqli_fetch_assoc($gallery_q)['total'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f8f9fa;
    }
    .card {
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .page-header {
      margin-bottom: 30px;
    }
    .table img {
      border-radius: 8px;
      object-fit: cover;
    }
  </style>
</head>
<body>

  <div class="container mt-4">
    <div class="page-header d-flex justify-content-between align-items-center">
      <h3 class="fw-bold mb-0">Dashboard</h3>
      <a href="all_user.php" class="btn btn-primary">
        <i class="bi bi-people-fill"></i> Manage Users
      </a>
    </div>

    <!-- 🔹 STAT CARDS -->
    <div class="row g-3">
      <div class="col-md-3">
        <div class="card text-bg-primary text-center">
          <div class="card-body">
            <h6>Total Users</h6>
            <h3>
              <?php
              $result = mysqli_query($con, "SELECT COUNT(*) AS total FROM users");
              $data = mysqli_fetch_assoc($result);
              echo $data['total'];
              ?>
            </h3>
          </div>
        </div>
      </div>
      <div class="col-md-3">
  <div class="card text-bg-dark text-center">
    <div class="card-body">
      <h6>Total Subscribers</h6>
      <h3><?php
       $subsQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM newsletter");
       $subsData  = mysqli_fetch_assoc($subsQuery);
       $subsCount = $subsData['total'];
       echo $subsCount;?></h3>
    </div>
  </div>
</div>
    <div class="col-md-3">
    <div class="card text-bg-success text-center">
        <div class="card-body">
            <h6>Total destination</h6>
            <h3><?= $destCount ?></h3>
        </div>
    </div>
</div>


    <div class="col-md-3">
    <div class="card text-bg-danger text-center">
        <div class="card-body">
            <h6>Total Gallery</h6>
            <h3><?= $gallery ?></h3>
        </div>
    </div>
</div>

      <div class="col-md-3">
        <div class="card text-bg-info text-center">
          <div class="card-body">
            <h6>New Users (Today)</h6>
            <h3>
              <?php
              $today = date('Y-m-d');
              $result = mysqli_query($con, "SELECT COUNT(*) AS today_users FROM users WHERE DATE(date) = '$today'");
              $data = mysqli_fetch_assoc($result);
              echo $data['today_users'];
              ?>
            </h3>
          </div>
        </div>
      </div>
    </div>

    <!-- 🔹 RECENT USERS -->
    <div class="card mt-4">
      <div class="card-header fw-bold"><i class="bi bi-person-lines-fill"></i> Recent Users</div>
      <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Username</th>
              <th>Email</th>
              <th>Image</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
            $result = mysqli_query($con, $query);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "
              <tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td><img src='../uploads/{$row['image']}' width='50' height='50'></td>
                <td>{$row['date']}</td>
              </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

   

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
