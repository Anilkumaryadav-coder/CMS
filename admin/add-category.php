<?php
include 'db.php';

/* Fetch clients */
$clients = [];
$clientQuery = mysqli_query($conn, "SELECT id, full_name, company_name FROM clients ORDER BY full_name ASC");
if ($clientQuery) {
    while ($row = mysqli_fetch_assoc($clientQuery)) {
        $clients[] = $row;
    }
}

if (isset($_POST['submit'])) {

    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $slug          = mysqli_real_escape_string($conn, $_POST['slug']);
    $description   = mysqli_real_escape_string($conn, $_POST['description']);
    $parent        = $_POST['parent_category'] ?: NULL;
    $status        = $_POST['status'];
    $display_order = $_POST['display_order'];
    $meta_title    = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $meta_desc     = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $show_nav      = isset($_POST['show_navigation']) ? 1 : 0;
    $featured      = isset($_POST['featured']) ? 1 : 0;
    $notes         = mysqli_real_escape_string($conn, $_POST['internal_notes']);

    // File uploads
    $category_image = "";
    if (!empty($_FILES['category_image']['name'])) {
        $category_image = time().'_'.$_FILES['category_image']['name'];
        move_uploaded_file($_FILES['category_image']['tmp_name'], "uploads/".$category_image);
    }

    $thumbnail = "";
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = time().'_'.$_FILES['thumbnail']['name'];
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], "uploads/".$thumbnail);
    }

    $sql = "INSERT INTO categories 
    (category_name, slug, description, parent_category, status, display_order,
     category_image, thumbnail, meta_title, meta_keywords, meta_description,
     show_navigation, featured, internal_notes)
    VALUES
    ('$category_name', '$slug', '$description', '$parent', '$status', '$display_order',
     '$category_image', '$thumbnail', '$meta_title', '$meta_keywords', '$meta_desc',
     '$show_nav', '$featured', '$notes')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Category Added Successfully'); window.location='view-categories.php';</script>";
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
<title>Add Category | CMS Admin</title>

<!-- Bootstrap -->
<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <!-- Custom CSS -->
  <link rel="stylesheet" href="/cms/css/styles.css">
<style>


.container {
    margin-left: 260px;
    padding: 30px;
}

h2 {
    font-weight: 500;
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 22px; /* medium heading */
}

.form-card {
    background: #fff;
    padding: 22px 26px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
}

.form-card h3 {
    font-size: 16px;
    margin-bottom: 16px;
    font-weight: 600;
    border-bottom: 1px solid #0d6efd;
    padding-bottom: 5px;
    color: #0d6efd;
}

label {
    font-weight: 500;
    font-size: 13px; /* medium label */
    margin-bottom: 4px;
}

/* 🔽 Smaller input fields */
input,
select,
textarea {
    width: 100%;
    padding: 7px 10px;        /* reduced padding */
    border-radius: 6px;
    border: 1px solid #ced4da;
    margin-bottom: 12px;
    font-size: 13px;          /* medium text */
}

input:focus,
select:focus,
textarea:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 5px rgba(13,110,253,0.25);
    outline: none;
}

textarea {
    resize: vertical;
    min-height: 70px; /* smaller textarea */
}

/* Button smaller & clean */
button[type="submit"] {
    background-color: #0d6efd;
    color: #fff;
    padding: 9px 22px;
    border: none;
    border-radius: 6px;
    font-weight: 500;
    font-size: 14px;
}

button[type="submit"]:hover {
    background-color: #0b5ed7;
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
<!-- CLIENTS SECTION -->
<h2 style="margin-bottom:15px;">Select Client</h2>

<h3> <label>Client</label></h3>
<select name="client_id" class="form-control" required>
    <option value="">-- Select Client --</option>
    <?php foreach ($clients as $client) { ?>
        <option value="<?= $client['id']; ?>">
            <?= htmlspecialchars($client['full_name']); ?>
            <?php if (!empty($client['company_name'])) { ?>
                (<?= htmlspecialchars($client['company_name']); ?>)
            <?php } ?>
        </option>
    <?php } ?>
</select>
<h2>Add Category</h2>

<form method="POST" enctype="multipart/form-data">
<div class="form-card">

<h3>Category Details</h3>
<div class="row g-3">

<div class="col-md-5">
<label>Category Name *</label>
<input type="text" name="category_name" id="category_name" required>
</div>

<div class="col-md-5">
<label>Slug *</label>
<input type="text" name="slug" id="slug" required>
</div>

<div class="col-12">
<label>Description</label>
<textarea name="description"></textarea>
</div>

<div class="col-md-6">
<label>Parent Category</label>
<select name="parent_category">
<option value="">None</option>
<option value="1">Products</option>
<option value="2">Services</option>
</select>
</div>

<div class="col-md-3">
<label>Status *</label>
<select name="status" required>
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<div class="col-md-3">
<label>Display Order</label>
<input type="number" name="display_order" value="0">
</div>

<div class="col-md-6">
<label>Category Image</label>
<input type="file" name="category_image">
</div>

<div class="col-md-6">
<label>Thumbnail</label>
<input type="file" name="thumbnail">
</div>

</div>

<h3 class="mt-4">SEO Information</h3>

<div class="row g-3">
<div class="col-md-6">
<label>SEO Meta Title</label>
<input type="text" name="meta_title">
</div>

<div class="col-md-6">
<label>SEO Keywords</label>
<input type="text" name="meta_keywords">
</div>

<div class="col-12">
<label>SEO Meta Description</label>
<textarea name="meta_description"></textarea>
</div>

<div class="col-md-6">
<label><input type="checkbox" name="show_navigation"> Show in Navigation</label>
</div>

<div class="col-md-6">
<label><input type="checkbox" name="featured"> Featured</label>
</div>

<div class="col-12">
<label>Internal Notes</label>
<textarea name="internal_notes"></textarea>
</div>
</div>

<div class="mt-4 text-end">
<button type="submit" name="submit">Save Category</button>
</div>

</div>
</form>
</div>

<script>
document.getElementById("category_name").addEventListener("keyup", function () {
    let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/(^-|-$)/g,'');
    document.getElementById("slug").value = slug;
});
</script>

</body>
</html>