<?php
include 'db.php';

$sql = "SELECT * FROM products ORDER BY display_order ASC, id DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query Failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Products | CMS Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body {
  background-color: #f2f6fa;
  font-family: 'Segoe UI', sans-serif;
}

/* MAIN CONTENT */
.container-fluid {
  margin-left: 120px;
  padding: 30px;
}

/* CENTER WRAPPER */
.content-wrapper {
  max-width: 1000px;
  margin: auto;
}

/* PAGE HEADER */
.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 14px;
}

.page-title {
  font-weight: 700;
  color: #0d6efd;
  font-size: 22px;
}

/* SEARCH */
.search-box {
  max-width: 220px;
}

/* CARD */
.table-card {
  background: #fff;
  padding: 18px;
  border-radius: 12px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.06);
  overflow-x: auto; /* ✅ prevents left-right jump */
}

/* TABLE */
.table {
  width: 100%;
  margin: 0;
}

.table th {
  font-size: 13px;
  font-weight: 600;
  color: #555;
  background: #f8faff;
  white-space: nowrap;
}

.table td {
  font-size: 13px;
  vertical-align: middle;
}

/* STATUS */
.badge-active {
  background: #e7f7ef;
  color: #198754;
}
.badge-inactive {
  background: #fdecec;
  color: #dc3545;
}

/* ACTION BUTTONS */
.btn-action {
  padding: 4px 8px;
  font-size: 12px;
  border-radius: 6px;
}

/* MOBILE */
@media (max-width: 768px) {
  .container-fluid {
    margin-left: 0;
    padding: 16px;
  }
  .content-wrapper {
    max-width: 100%;
  }
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="container-fluid">
  <div class="content-wrapper">

    <!-- HEADER -->
    <div class="page-header">
      <h2 class="page-title">View Products</h2>

      <div class="d-flex align-items-center gap-2">
        <input type="text" class="form-control form-control-sm search-box" placeholder="Search">
        <a href="add-product.php" class="btn btn-primary btn-sm">
          <i class="bi bi-plus-lg"></i> Add Product
        </a>
      </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th width="20">#</th>
            <th width="80" >Product</th>
            <th width="80">Category</th>
            <th width="80">Price</th>
            <th width="80">Status</th>
            <th width="80">Featured</th>
            <th width="100 " class="text-center">Actions</th>
          </tr>
        </thead>

        <tbody>
          <?php
$i = 1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td><?= $i++; ?></td>

    <td>
        <strong><?= htmlspecialchars($row['product_name']); ?></strong><br>
        <small class="text-muted"><?= htmlspecialchars($row['slug']); ?></small>
    </td>

    <td><?= $row['category_id']; ?></td>

    <td>₹<?= number_format($row['price'], 2); ?></td>

    <td>
        <?= $row['status'] == 1
            ? '<span class="badge badge-active">Active</span>'
            : '<span class="badge badge-inactive">Inactive</span>'; ?>
    </td>

    <td><?= $row['featured'] ? 'Yes' : 'No'; ?></td>

    <td class="text-center">
        <a href="edit-product.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-action text-white">
            <i class="bi bi-pencil"></i>
        </a>

        <a href="delete-product.php?id=<?= $row['id']; ?>"
           onclick="return confirm('Are you sure?')"
           class="btn btn-danger btn-action">
            <i class="bi bi-trash"></i>
        </a>
    </td>
</tr>
<?php
    }
} else {
?>
<tr>
    <td colspan="7" class="text-center text-muted py-3">
        No products found
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
