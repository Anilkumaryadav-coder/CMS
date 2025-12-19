<?php
include 'db.php';

/* Fetch categories */
$categories = mysqli_query($conn,
    "SELECT id, category_name FROM categories WHERE status = 1 ORDER BY category_name ASC"
);

/* Check ID */
if (!isset($_GET['id'])) {
    header("Location: view-product.php");
    exit;
}

$id = (int)$_GET['id'];

/* Fetch product */
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    header("Location: view-product.php");
    exit;
}

/* UPDATE */
if (isset($_POST['update'])) {

    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $mrp = $_POST['mrp'];
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $stock = $_POST['stock'];
    $display_order = $_POST['display_order'];
    $status = $_POST['status'];
    $featured = $_POST['featured'];
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $long_description = mysqli_real_escape_string($conn, $_POST['long_description']);

    mysqli_query($conn, "
        UPDATE products SET
        product_name='$product_name',
        slug='$slug',
        category_id='$category_id',
        price='$price',
        mrp='$mrp',
        sku='$sku',
        stock='$stock',
        display_order='$display_order',
        status='$status',
        featured='$featured',
        short_description='$short_description',
        long_description='$long_description'
        WHERE id=$id
    ");

    header("Location: view-product.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">
</head>

<body>
<?php include 'sidebar.php'; ?>

<div class="container" style="margin-left:260px;padding:30px">
<h3>Edit Product</h3>

<form method="POST">

<div class="row g-3">

<div class="col-md-6">
<label>Product Name</label>
<input type="text" name="product_name" class="form-control"
value="<?= htmlspecialchars($data['product_name']); ?>" required>
</div>

<div class="col-md-6">
<label>Slug</label>
<input type="text" name="slug" class="form-control"
value="<?= htmlspecialchars($data['slug']); ?>" required>
</div>

<div class="col-md-6">
<label>Category</label>
<select name="category_id" class="form-select">
<?php while ($c = mysqli_fetch_assoc($categories)) { ?>
<option value="<?= $c['id']; ?>"
<?= $data['category_id'] == $c['id'] ? 'selected' : ''; ?>>
<?= htmlspecialchars($c['category_name']); ?>
</option>
<?php } ?>
</select>
</div>

<div class="col-md-3">
<label>Price</label>
<input type="number" name="price" class="form-control"
value="<?= $data['price']; ?>">
</div>

<div class="col-md-3">
<label>MRP</label>
<input type="number" name="mrp" class="form-control"
value="<?= $data['mrp']; ?>">
</div>

<div class="col-md-4">
<label>Status</label>
<select name="status" class="form-select">
<option value="1" <?= $data['status']==1?'selected':''; ?>>Active</option>
<option value="0" <?= $data['status']==0?'selected':''; ?>>Inactive</option>
</select>
</div>

<div class="col-md-4">
<label>Featured</label>
<select name="featured" class="form-select">
<option value="0" <?= $data['featured']==0?'selected':''; ?>>No</option>
<option value="1" <?= $data['featured']==1?'selected':''; ?>>Yes</option>
</select>
</div>

<div class="col-12">
<label>Short Description</label>
<textarea name="short_description" class="form-control"><?= htmlspecialchars($data['short_description']); ?></textarea>
</div>

<div class="col-12">
<label>Long Description</label>
<textarea name="long_description" class="form-control"><?= htmlspecialchars($data['long_description']); ?></textarea>
</div>

<div class="col-12 mt-3">
<button type="submit" name="update" class="btn btn-primary">
<i class="bi bi-save"></i> Update Product
</button>
</div>

</div>
</form>
</div>

</body>
</html>
