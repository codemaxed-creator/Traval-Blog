<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<h4 class="fw-bold mb-4">
  <i class="bi bi-envelope-paper me-2"></i>Contact Messages
</h4>

<?php
include '../app/core/init.php';

$sql = "SELECT * FROM contact_messages ORDER BY id DESC";
$result = mysqli_query($con, $sql);
?>

<div class="card shadow-sm border-0">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle table-hover table-striped">
        <thead class="table-dark">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php while($row = mysqli_fetch_assoc($result)){ ?>
            <tr>
              <td><?= $row['id']; ?></td>
              <td><?= $row['NAME']; ?></td>
              <td><?= $row['email']; ?></td>
              <td><span class="badge bg-primary"><?= $row['SUBJECT']; ?></span></td>
              <td style="max-width: 250px;"><?= $row['message']; ?></td>

              <td>
                <span class="badge bg-light text-dark">
                    <?= $row['created_at']; ?>
                </span>
              </td>

              <td>
                <a href="delete_contact.php?id=<?= $row['id']; ?>"
                   class="btn btn-sm btn-outline-danger"
                   onclick="return confirm('Delete this message?');">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>

      </table>
    </div>
  </div>
</div>

    <title>Document</title>
</head>
<body>
    
</body>
</html>