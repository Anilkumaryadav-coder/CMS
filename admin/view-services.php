<?php
include "db.php";

$query = "
SELECT s.*, c.category_name 
FROM services s
LEFT JOIN categories c ON s.category_id = c.id
ORDER BY s.display_order ASC
";

$result = mysqli_query($conn, $query);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Services | CMS Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body {
  background-color: #f2f6fa;
  font-family: 'Segoe UI', sans-serif;
}

.container {
  margin-left: 270px;
  padding: 30px;
}

h2 {
  font-weight: 700;
  margin-bottom: 25px;
  color: #0d6efd;
}

.table-card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.table th {
  background-color: #f1f5fb;
  font-weight: 600;
}

.badge-active {
  background-color: #198754;
}

.badge-inactive {
  background-color: #dc3545;
}

.action-btns a {
  margin-right: 6px;
}

@media (max-width: 768px) {
  .container {
    margin-left: 0;
    padding: 20px;
  }
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="container">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>View Services</h2>
    <a href="add-service.php" class="btn btn-primary">
      <i class="bi bi-plus-circle"></i> Add Service
    </a>
  </div>

  <div class="table-card">
    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Service Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Duration</th>
          <th>Featured</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>

      <tbody>

<?php $i=1; while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
  <td><?= $i++; ?></td>
  <td><?= htmlspecialchars($row['service_name']); ?></td>
  <td><?= htmlspecialchars($row['category_name']); ?></td>
  <td><?= $row['price']; ?></td>
  <td><?= $row['duration']; ?></td>
  <td>
    <span class="badge <?= $row['featured']=='Yes'?'bg-warning text-dark':'bg-secondary'; ?>">
      <?= $row['featured']; ?>
    </span>
  </td>
  <td>
    <span class="badge <?= $row['status']=='Active'?'badge-active':'badge-inactive'; ?>">
      <?= $row['status']; ?>
    </span>
  </td>
  <td class="action-btns">
    <a href="edit-service.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-warning">
      <i class="bi bi-pencil-square"></i>
    </a>
    <a href="delete-service.php?id=<?= $row['id']; ?>" 
       class="btn btn-sm btn-danger"
       onclick="return confirm('Are you sure?')">
      <i class="bi bi-trash"></i>
    </a>
  </td>
</tr>
<?php } ?>
</tbody>
    </table>
  </div>

</div>

</body>
</html>
