<?php
include '../app/core/init.php';


if (!isset($con)) {
    die("DB connection not found.");
}

// Fetch destinations
$query = "SELECT * FROM destinations ORDER BY id DESC";
$dest = mysqli_query($con, $query);

if (!$dest) {
    die("SQL Error: " . mysqli_error($con));
}
?>







<div class="container py-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold">
            <i class="bi bi-geo-alt-fill"></i> Destinations
        </h3>

        <a href="add_destination.php" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Destination
        </a>
    </div>

    <!-- TABLE CARD -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white fw-bold">
            Destination List
        </div>

        <div class="card-body table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                     if (mysqli_num_rows($dest) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($dest)): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>

                            <td>
                                <?php if ($row['image']): ?>
                                    <img src="../uploads/<?= $row['image'] ?>" 
                                        style="width:70px;height:60px;object-fit:cover;border-radius:6px;">
                                <?php else: ?>
                                    <span class="text-muted">No Image</span>
                                <?php endif; ?>
                            </td>

                            <td class="fw-semibold"><?= htmlspecialchars($row['title']) ?></td>

                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= htmlspecialchars($row['type']) ?></td>

                            <td style="max-width:240px;">
                                <div style="white-space: normal;">
                                    <?= nl2br(htmlspecialchars($row['description'])) ?>
                                </div>
                            </td>

                                <span class="badge bg-light text-dark">
                                    <?= $row['created_at'] ?? 'date' ?>
                                </span>
                            </td>
                            <td><?= ($row['date']) ?></td>

                            <td>
                                <!-- <a href="?page=edit_destination&id=<?= $row['id'] ?>" 
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil-square"></i>
                                </a> -->
<a onclick="return confirm('Delete this destination?')" 
   href="delete_destination.php?id=<?= $row['id'] ?>" 
   class="btn btn-sm btn-outline-danger">
    <i class="bi bi-trash"></i>
</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">
                                No destinations found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
