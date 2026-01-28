<h4 class="fw-bold mb-4">
  <i class="bi bi-images me-2"></i>Gallery
  <a href="add_gallery.php" class="btn btn-primary">
    <i class="bi bi-plus-circle"></i> Add Image
  </a>
</h4>

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
            <th scope='col'>Image</th>
            <th scope='col'>Date</th>
            <th scope='col'>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
          $sql = "SELECT * FROM gallery  ORDER BY id DESC";
          $result = mysqli_query($con, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "
              <tr>
                <th>{$row['id']}</th>

              

                <td>
                  <img src='../uploads/gallery/{$row['image']}' 
                       width='90' height='70' 
                       style='object-fit:cover; border-radius:8px;'>
                </td>

                <td><span class='badge bg-light text-dark'>{$row['date']}</span></td>

                <td>
             

                  <a href='delete_gallery.php?id={$row['id']}' 
                     class='btn btn-sm btn-outline-danger'
                     onclick=\"return confirm('Delete this image?');\">
                    <i class='bi bi-trash-fill'></i>
                  </a>
                </td>
              </tr>";
            }
          } else {
            echo "
            <tr>
              <td colspan='5' class='text-center text-muted py-4'>
                <i class='bi bi-exclamation-circle'></i> No images found
              </td>
            </tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
