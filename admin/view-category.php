<?php
include 'db.php';
$result = mysqli_query($conn, "SELECT * FROM categories ORDER BY display_order ASC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Categories | CMS Admin</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
/* ===== GLOBAL ===== */
body {
    background-color: #f2f6fa;
    font-family: 'Segoe UI', sans-serif;
    font-size: 14px;
    overflow-x: hidden; /* 🔴 prevents horizontal overflow */
}

/* ===== SIDEBAR SAFE CONTENT AREA ===== */
:root {
    --sidebar-width: 270px;
}

.container {
    margin-left: var(--sidebar-width);
    width: calc(100% - var(--sidebar-width));
    max-width: 100%;
    padding: 28px;
}

/* ===== HEADER ===== */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 18px;
}

h2 {
    font-weight: 600;
    color: #0d6efd;
    font-size: 22px;
}

/* ===== CARD ===== */
.card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    border: none;
}

/* ===== TABLE ===== */
.table-responsive {
    overflow-x: auto;
}

.table {
    font-size: 13px;
    margin-bottom: 0;
    white-space: nowrap;
}

.table thead th {
    background: #f1f5fb;
    font-weight: 600;
    padding: 12px;
    border-bottom: 2px solid #e3e7ed;
}

.table tbody td {
    padding: 11px;
    vertical-align: middle;
}

.table-hover tbody tr:hover {
    background-color: #f9fbff;
}

/* ===== BADGES ===== */
.badge {
    font-size: 11px;
    padding: 6px 10px;
    border-radius: 20px;
    font-weight: 500;
}

/* ===== ACTION BUTTONS ===== */
.action-btns {
    display: flex;
    gap: 6px;
}

.action-btns a {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 5px 10px;
    font-size: 12px;
    border-radius: 6px;
    text-decoration: none;
    transition: 0.2s;
}

.action-btns .edit {
    background: #0d6efd;
    color: #fff;
}

.action-btns .delete {
    background: #dc3545;
    color: #fff;
}

.action-btns a:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

/* ===== RESPONSIVE ===== */
@media (max-width: 992px) {
    .container {
        margin-left: 0;
        width: 100%;
        padding: 20px;
    }
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="container">

    <div class="page-header">
        <h2>View Categories</h2>
        <a href="add-category.php" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add Category
        </a>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Navigation</th>
                        <th>Featured</th>
                        <th>Order</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php if (mysqli_num_rows($result) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-folder-x"></i> No categories found
                        </td>
                    </tr>
                <?php } ?>

                <?php $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= htmlspecialchars($row['category_name']); ?></td>
                        <td><?= htmlspecialchars($row['slug']); ?></td>

                        <td>
                            <?= $row['status']
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-secondary">Inactive</span>'; ?>
                        </td>

                        <td>
                            <?= $row['show_navigation']
                                ? '<span class="badge bg-info">Yes</span>'
                                : '—'; ?>
                        </td>

                        <td>
                            <?= $row['featured']
                                ? '<span class="badge bg-warning text-dark">Yes</span>'
                                : '—'; ?>
                        </td>

                        <td><?= $row['display_order']; ?></td>

                        <td class="action-btns">
                            <a href="edit-category.php?id=<?= $row['id']; ?>" class="edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="delete-category.php?id=<?= $row['id']; ?>" class="delete"
                               onclick="return confirm('Delete this category?')">
                                <i class="bi bi-trash"></i> Delete
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
