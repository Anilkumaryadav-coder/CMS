<?php
include 'db.php';

/* ================= EDIT MODE ================= */
$editMode = false;
$data = [];
if (isset($_GET['id'])) {
    $editMode = true;
    $id = (int) $_GET['id'];
    $res = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
    $data = mysqli_fetch_assoc($res);
}


/* ================= SAVE ================= */
if (isset($_POST['submit'])) {

    $id             = $_POST['id'] ?? '';
    $category_name  = mysqli_real_escape_string($conn, $_POST['category_name']);
    $slug           = mysqli_real_escape_string($conn, $_POST['slug']);
    $description    = mysqli_real_escape_string($conn, $_POST['description']);
    $parent         = $_POST['parent_category'] ?: NULL;
    $status         = $_POST['status'];
    $display_order  = $_POST['display_order'];
    $meta_title     = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_keywords  = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $meta_desc      = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $show_nav       = isset($_POST['show_navigation']) ? 1 : 0;
    $featured       = isset($_POST['featured']) ? 1 : 0;
    $notes          = mysqli_real_escape_string($conn, $_POST['internal_notes']);

    /* IMAGE UPLOAD */
    function uploadImage($field, $old = '') {
        if (!empty($_FILES[$field]['name'])) {
            $file = time().'_'.$_FILES[$field]['name'];
            move_uploaded_file($_FILES[$field]['tmp_name'], "../uploads/".$file);
            return $file;
        }
        return $old;
    }

    $category_image = uploadImage('category_image', $_POST['old_category_image'] ?? '');
    $thumbnail      = uploadImage('thumbnail', $_POST['old_thumbnail'] ?? '');

    if ($id) {
        /* UPDATE */
        $sql = "UPDATE categories SET
            category_name='$category_name',
            slug='$slug',
            description='$description',
            parent_category='$parent',
            status='$status',
            display_order='$display_order',
            category_image='$category_image',
            thumbnail='$thumbnail',
            meta_title='$meta_title',
            meta_keywords='$meta_keywords',
            meta_description='$meta_desc',
            show_navigation='$show_nav',
            featured='$featured',
            internal_notes='$notes'
            WHERE id='$id'";
    } else {
        /* INSERT */
        $sql = "INSERT INTO categories
        (category_name, slug, description, parent_category, status, display_order,
         category_image, thumbnail, meta_title, meta_keywords, meta_description,
         show_navigation, featured, internal_notes)
        VALUES
        ('$category_name','$slug','$description','$parent','$status','$display_order',
         '$category_image','$thumbnail','$meta_title','$meta_keywords','$meta_desc',
         '$show_nav','$featured','$notes')";
    }

    mysqli_query($conn, $sql);
    header("Location: view-category.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title><?= $editMode ? 'Edit Category' : 'Add Category'; ?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">
</head>

<body>
<?php include 'sidebar.php'; ?>

<div class="container" style="margin-left:260px;padding:30px">
<h3><?= $editMode ? 'Edit Category' : 'Add Category'; ?></h3>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="id" value="<?= $data['id'] ?? '' ?>">
<input type="hidden" name="old_category_image" value="<?= $data['category_image'] ?? '' ?>">
<input type="hidden" name="old_thumbnail" value="<?= $data['thumbnail'] ?? '' ?>">

<div class="row g-3">

<div class="col-md-6">
<label>Category Name</label>
<input type="text" name="category_name" id="category_name" class="form-control"
value="<?= $data['category_name'] ?? '' ?>" required>
</div>

<div class="col-md-6">
<label>Slug</label>
<input type="text" name="slug" id="slug" class="form-control"
value="<?= $data['slug'] ?? '' ?>" required>
</div>

<div class="col-12">
<label>Description</label>
<textarea name="description" class="form-control"><?= $data['description'] ?? '' ?></textarea>
</div>

<div class="col-md-6">
<label>Parent Category</label>
<select name="parent_category" class="form-select">
<option value="">None</option>
<option value="1" <?= (($data['parent_category'] ?? '')==1)?'selected':''; ?>>Products</option>
<option value="2" <?= (($data['parent_category'] ?? '')==2)?'selected':''; ?>>Services</option>
</select>
</div>

<div class="col-md-3">
<label>Status</label>
<select name="status" class="form-select">
<option value="1" <?= (($data['status'] ?? '')==1)?'selected':''; ?>>Active</option>
<option value="0" <?= (($data['status'] ?? '')==0)?'selected':''; ?>>Inactive</option>
</select>
</div>

<div class="col-md-3">
<label>Order</label>
<input type="number" name="display_order" class="form-control"
value="<?= $data['display_order'] ?? 0 ?>">
</div>

<div class="col-md-6">
<label>Category Image</label>
<input type="file" name="category_image" class="form-control">
</div>

<div class="col-md-6">
<label>Thumbnail</label>
<input type="file" name="thumbnail" class="form-control">
</div>

<div class="col-md-6 mt-2">
<label><input type="checkbox" name="show_navigation"
<?= !empty($data['show_navigation'])?'checked':''; ?>> Show in Navigation</label>
</div>

<div class="col-md-6 mt-2">
<label><input type="checkbox" name="featured"
<?= !empty($data['featured'])?'checked':''; ?>> Featured</label>
</div>

<div class="col-12">
<label>Internal Notes</label>
<textarea name="internal_notes" class="form-control"><?= $data['internal_notes'] ?? '' ?></textarea>
</div>

<div class="col-12 mt-3">
<button type="submit" name="submit" class="btn btn-primary">
<?= $editMode ? 'Update Category' : 'Save Category'; ?>
</button>
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
