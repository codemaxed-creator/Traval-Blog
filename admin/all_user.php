      
<h4 class="fw-bold mb-4"><i class="bi bi-people-fill me-2"></i>Users<a href="add_user.php" class="btn btn-primary"><i class="bi bi-person-plus"></i> Add User</a></h4>

<?php
include '../app/core/init.php';
?>

<div class="card shadow-sm border-0">
  <div class="card-body">
    <div class="table-responsive">
      <table class="table align-middle table-hover table-striped">
        <thead class="table-dark">
          <tr>
            <th scope='col'>#</th>
            <th scope='col'>Username</th>
            <th scope='col'>Email</th>
            <th scope='col'>Image</th>
            <th scope='col'>Date</th>
            <th scope='col'>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM `users` ORDER BY id DESC";
          $result = mysqli_query($con, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "
              <tr>
                <th scope='row'>{$row['id']}</th>
                <td><strong>{$row['username']}</strong></td>
                <td>{$row['email']}</td>
                <td>
                  <img src='../uploads/{$row['image']}' 
                       width='70' height='70' 
                       style='object-fit:cover;'>
                </td>
                <td><span class='badge bg-light text-dark'>{$row['date']}</span></td>
                <td>
                  <a href='edit_user.php?id={$row['id']}' class='btn btn-sm btn-outline-primary me-1'>
                    <i class='bi bi-pencil-square'></i>
                  </a>
                  <a href='delete_user.php?id={$row['id']}' 
                     class='btn btn-sm btn-outline-danger' 
                     onclick=\"return confirm('Are you sure you want to delete this user?');\">
                    <i class='bi bi-trash-fill'></i>
                  </a>
                </td>
              </tr>";
            }
          } else {
            echo "
            <tr>
              <td colspan='6' class='text-center text-muted py-4'>
                <i class='bi bi-exclamation-circle me-1'></i> No users found
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
