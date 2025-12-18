<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Services</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">
<style>
body {
    background: #f5f7fa;
}
.main-container {
    margin-left: 260px;
    padding: 30px;
}
.table img {
    width: 70px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
}
.badge-active {
    background: #16a34a;
}
.badge-inactive {
    background: #dc2626;
}
</style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-container">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Services List</h5>
            <a href="services.php" class="btn btn-primary btn-sm">
                <i class="bi bi-plus"></i> Add Service
            </a>
        </div>

        <div class="card-body">
            <table class="table table-bordered align-middle table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Service Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $query = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");

                while ($row = mysqli_fetch_assoc($query)) {
                ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td>
                       <img src="../uploads/services/<?= $row['image_1']; ?>" width="70">
                        </td>
                        <td>
                            <strong><?= $row['service_name']; ?></strong><br>
                            <small><?= $row['service_slug']; ?></small>
                        </td>
                        <td><?= $row['category']; ?></td>
                        <td>
                            <span class="badge <?= $row['status']=='active'?'badge-active':'badge-inactive'; ?>">
                                <?= ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?= $row['featured'] ? '<span class="badge bg-warning text-dark">Yes</span>' : 'No'; ?>
                        </td>
                        <td>
                            <a href="edit-service.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-info">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="delete-service.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Delete this service?')" 
                               class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
