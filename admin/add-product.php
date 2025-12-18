<?php
include 'db.php';

/* Fetch clients */
$clients = [];
$clientQuery = mysqli_query($conn, "SELECT id, full_name, company_name, website FROM clients ORDER BY full_name ASC");
if ($clientQuery) {
    while ($row = mysqli_fetch_assoc($clientQuery)) {
        $clients[] = $row;
    }
}

/* Fetch categories */
$catResult = mysqli_query(
    $conn,
    "SELECT id, category_name 
     FROM categories 
     WHERE status = 1 
     ORDER BY display_order ASC"
);

if (isset($_POST['submit'])) {

    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $category_id = (int) $_POST['category_id'];
    $price = $_POST['price'];
    $mrp = $_POST['mrp'];
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $stock = $_POST['stock'];
    $display_order = $_POST['display_order'];
    $status = $_POST['status'];
    $featured = $_POST['featured'];
    $short_description = mysqli_real_escape_string($conn, $_POST['short_description']);
    $long_description = mysqli_real_escape_string($conn, $_POST['long_description']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);

    $sql = "INSERT INTO products 
    (product_name, slug, category_id, price, mrp, sku, stock, display_order, status, featured, short_description, long_description, meta_title, meta_keywords, meta_description) 
    VALUES 
    ('$product_name', '$slug', '$category_id', '$price', '$mrp', '$sku', '$stock', '$display_order', '$status', '$featured', '$short_description', '$long_description', '$meta_title', '$meta_keywords', '$meta_description')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Product Added Successfully'); window.location='view-product.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Product | CMS Admin</title>

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
  margin-left: 150px;
  padding: 30px;
}

/* CENTER FORM */
.content-wrapper {
  max-width: 1000px;
  margin: auto;
}

/* PAGE TITLE */
.page-title {
  font-weight: 700;
  color: #0d6efd;
  margin-bottom: 20px;
  font-size: 22px;
}
h2 {
    font-weight: 500;
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 22px; /* medium heading */
}
/* FORM CARD */
.form-card {
  background: #fff;
  padding: 20px;
  border-radius: 12px;
  box-shadow: 0 6px 16px rgba(0,0,0,0.06);
  margin-bottom: 18px;
}

/* SECTION TITLE */
.form-card h4 {
  font-size: 18px;
  font-weight: 600;
  color: #0d6efd;
  border-bottom: 1px solid #e6ecf8;
  padding-bottom: 4px;
  margin-bottom: 14px;
}

/* LABEL */
label {
  font-weight: 500;
  font-size: 12.5px;
  margin-bottom: 4px;
  color: #444;
}

/* INPUTS */
input.form-control,
select.form-select,
textarea.form-control {
  border-radius: 6px;
  padding: 6px 10px;
  font-size: 15px;
  min-height: 32px;
}

/* SHORT INPUT WIDTHS */
.input-xs { max-width: 180px; }
.input-sm { max-width: 240px; }
.input-md { max-width: 300px; }
.input-lg { max-width: 100%; }

textarea { resize: vertical; }

/* BUTTON */
.btn-save {
  padding: 8px 24px;
  font-size: 13.5px;
  font-weight: 600;
  border-radius: 8px;
}

/* REDUCE GAP */
.row.g-3 {
  --bs-gutter-y: 0.6rem;
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
  .input-xs,
  .input-sm,
  .input-md {
    max-width: 100%;
  }
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="container-fluid">
  <div class="content-wrapper">
   <h3> <label>Client</label></h3>
<select name="client_id" class="form-control" required>
    <option value="">-- Select Client --</option>
    <?php foreach ($clients as $client) { ?>
        <option value="<?= $client['id']; ?>">
            <?= htmlspecialchars($client['full_name']); ?>
            <?php if (!empty($client['website'])) { ?>
                (<?= htmlspecialchars($client['website']); ?>)
            <?php } ?>
        </option>
    <?php } ?>
</select>

    <h2 class="page-title">Add New Product</h2>

    <form method="POST">


      <!-- BASIC INFO -->
      <div class="form-card">
        <h4>Basic Info</h4>
        <div class="row g-3">

          <div class="col-md-6">
            <label>Product Name</label>
             <input type="text" id="product_name" class="form-control input-md">
          </div>

        <div class="col-md-6">
         <label>Slug</label>
         <input type="text" id="slug" class="form-control input-sm">
        </div>


            <div class="col-md-6">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>

                    <?php while ($cat = mysqli_fetch_assoc($catResult)) { ?>
                        <option value="<?= $cat['id']; ?>">
                            <?= htmlspecialchars($cat['category_name']); ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

          <div class="col-md-4">
            <label>Status</label>
            <select class="form-select input-xs">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="col-md-4">
            <label>Featured</label>
            <select class="form-select input-xs">
              <option>No</option>
              <option>Yes</option>
            </select>
          </div>

          <div class="col-md-6">
            <label>Price</label>
            <input type="number" class="form-control input-sm">
          </div>

          <div class="col-md-6">
            <label>MRP</label>
            <input type="number" class="form-control input-sm">
          </div>

        </div>
      </div>

      <!-- INVENTORY -->
      <div class="form-card">
        <h4>Inventory</h4>
        <div class="row g-3">

          <div class="col-md-4">
            <label>SKU</label>
            <input type="text" class="form-control input-sm">
          </div>

          <div class="col-md-4">
            <label>Stock</label>
            <input type="number" class="form-control input-xs">
          </div>

          <div class="col-md-4">
            <label>Order</label>
            <input type="number" class="form-control input-xs">
          </div>

        </div>
      </div>

      <!-- DESCRIPTION -->
      <div class="form-card">
        <h4>Description</h4>
        <textarea class="form-control input-lg mb-2" rows="2" placeholder="Short description"></textarea>
        <textarea class="form-control input-lg" rows="4" placeholder="Long description"></textarea>
      </div>

      <!-- MEDIA -->
      <div class="form-card">
        <h4>Media</h4>
        <div class="row g-3">

          <div class="col-md-4">
            <label>Main Image</label>
            <input type="file" class="form-control input-sm">
          </div>

          <div class="col-md-4">
            <label>Gallery</label>
            <input type="file" class="form-control input-sm" multiple>
          </div>

          <div class="col-md-4">
            <label>File</label>
            <input type="file" class="form-control input-sm">
          </div>

        </div>
      </div>

      <!-- SEO -->
      <div class="form-card">
        <h4>SEO</h4>
        <div class="row g-3">

          <div class="col-md-4">
            <label>Meta Title</label>
            <input type="text" class="form-control input-md">
          </div>

          <div class="col-md-4">
            <label>Keywords</label>
            <input type="text" class="form-control input-md">
          </div>

          <div class="col-md-4">
            <label>Description</label>
            <textarea class="form-control input-lg" rows="1"></textarea>
          </div>

        </div>
      </div>

      <!-- SUBMIT -->
      <div class="text-end">
        <button type="submit" name="submit" class="btn btn-primary btn-save">
          <i class="bi bi-save"></i> Save Product
        </button>
      </div>

    </form>

  </div>
</div>
<script>
document.getElementById("product_name").addEventListener("keyup", function () {
    let text = this.value;

    let slug = text
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, "") // remove special chars
        .replace(/\s+/g, "-")         // spaces to hyphen
        .replace(/-+/g, "-");         // remove multiple hyphens

    document.getElementById("slug").value = slug;
});
</script>

</body>
</html>
