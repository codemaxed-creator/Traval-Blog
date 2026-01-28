<?php
include '../app/core/init.php';

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];

    mysqli_query($con, "DELETE FROM newsletter WHERE id = $id");

   echo "<script>
    alert('Subscriber Deleted Successfully!');
    window.location.href='dashboard.php'; 
</script>";
exit;

}



// Fetch all subscribers
$query = "SELECT * FROM newsletter ORDER BY id DESC";
$result = mysqli_query($con, $query);
// if($result){
//   echo "it is susccfully connect";
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Subscribers List</title>

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
  </style>
</head>
<body>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">Subscribers List</h3>
        <a href="dashboard.php" class="btn btn-primary">
            <i class="bi bi-speedometer2"></i> Back to Dashboard
        </a>
    </div>

    <div class="card">
        <div class="card-header fw-bold">
            <i class="bi bi-envelope-fill"></i> All Subscribers
        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                    $i = 1;
                    while($row = mysqli_fetch_assoc($result)){ 
                        echo "
                        <tr>
                            <td>{$i}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['date']}</td>
                            <td>
                                <a href='sub.php?delete={$row['id']}'
                                   class='btn btn-danger btn-sm'
                                   onclick=\"return confirm('Delete this subscriber?');\">
                                   <i class='bi bi-trash'></i> Delete
                                </a>
                            </td>
                        </tr>";
                        $i++;
                    }
                    ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>
