<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-services.php");
    exit;
}

$id = (int)$_GET['id'];

/* Fetch service data */
$result = mysqli_query($conn, "SELECT * FROM services WHERE id=$id");
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Service not found";
    exit;
}

/* Fetch categories */
$catResult = mysqli_query($conn, "SELECT id, category_name FROM categories WHERE status=1");

/* Image upload function */
function uploadImage($input, $oldImage = null) {
    if (!empty($_FILES[$input]['name'])) {
        if ($oldImage && file_exists("../uploads/services/".$oldImage)) {
            unlink("../uploads/services/".$oldImage);
        }
        $filename = time().'_'.$_FILES[$input]['name'];
        move_uploaded_file($_FILES[$input]['tmp_name'], "../uploads/services/".$filename);
        return $filename;
    }
    return $oldImage;
}

/* Update */
if (isset($_POST['update'])) {

    $service_name = $_POST['service_name'];
    $service_title = $_POST['service_title'];
    $service_slug = $_POST['service_slug'];
    $category = $_POST['category_id'];
    $short_description = $_POST['short_description'];
    $long_description = $_POST['long_description'];
    $status = $_POST['status'];
    $featured = $_POST['featured'];
    $display_order = $_POST['display_order'];

    $image_1 = uploadImage('service_image_1', $_POST['old_image_1']);
    $image_2 = uploadImage('service_image_2', $_POST['old_image_2']);
    $image_3 = uploadImage('service_image_3', $_POST['old_image_3']);
    $image_4 = uploadImage('service_image_4', $_POST['old_image_4']);

    $sql = "UPDATE services SET
        service_name='$service_name',
        service_title='$service_title',
        service_slug='$service_slug',
        category='$category',
        short_description='$short_description',
        long_description='$long_description',
        image_1='$image_1',
        image_2='$image_2',
        image_3='$image_3',
        image_4='$image_4',
        status='$status',
        featured='$featured',
        display_order='$display_order'
        WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Service Updated');window.location='view-services.php';</script>";
    } else {
        die(mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Service</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">
</head>
<body>
<?php include 'sidebar.php'; ?>
<div class="container mt-4">
<h3>Edit Service</h3>

<form method="post" enctype="multipart/form-data">

<input type="hidden" name="old_image_1" value="<?= $data['image_1'] ?>">
<input type="hidden" name="old_image_2" value="<?= $data['image_2'] ?>">
<input type="hidden" name="old_image_3" value="<?= $data['image_3'] ?>">
<input type="hidden" name="old_image_4" value="<?= $data['image_4'] ?>">

<div class="row g-3">
<div class="col-md-6">
<label>Service Name</label>
<input type="text" name="service_name" value="<?= $data['service_name'] ?>" class="form-control">
</div>

<div class="col-md-6">
<label>Service Title</label>
<input type="text" name="service_title" value="<?= $data['service_title'] ?>" class="form-control">
</div>

<div class="col-md-6">
<label>Service Slug</label>
<input type="text" name="service_slug" value="<?= $data['service_slug'] ?>" class="form-control">
</div>

<div class="col-md-6">
<label>Category</label>
<select name="category_id" class="form-select">
<?php while ($cat = mysqli_fetch_assoc($catResult)) { ?>
<option value="<?= $cat['id'] ?>" <?= $cat['id']==$data['category']?'selected':'' ?>>
<?= $cat['category_name'] ?>
</option>
<?php } ?>
</select>
</div>

<div class="col-md-6">
<label>Short Description</label>
<textarea name="short_description" class="form-control"><?= $data['short_description'] ?></textarea>
</div>

<div class="col-md-6">
<label>Long Description</label>
<textarea name="long_description" class="form-control"><?= $data['long_description'] ?></textarea>
</div>

<?php for($i=1;$i<=4;$i++){ ?>
<div class="col-md-3">
<label>Image <?= $i ?></label><br>
<img src="../uploads/services/<?= $data['image_'.$i] ?>" width="80"><br>
<input type="file" name="service_image_<?= $i ?>" class="form-control mt-2">
</div>
<?php } ?>

<div class="col-md-4">
<label>Status</label>
<select name="status" class="form-select">
<option value="active" <?= $data['status']=='active'?'selected':'' ?>>Active</option>
<option value="inactive" <?= $data['status']=='inactive'?'selected':'' ?>>Inactive</option>
</select>
</div>

<div class="col-md-4">
<label>Featured</label>
<select name="featured" class="form-select">
<option value="0" <?= $data['featured']==0?'selected':'' ?>>No</option>
<option value="1" <?= $data['featured']==1?'selected':'' ?>>Yes</option>
</select>
</div>

<div class="col-md-4">
<label>Display Order</label>
<input type="number" name="display_order" value="<?= $data['display_order'] ?>" class="form-control">
</div>
</div>

<button type="submit" name="update" class="btn btn-success mt-4">Update Service</button>
<a href="view-services.php" class="btn btn-secondary mt-4">Back</a>

</form>
</div>

<script>
document.getElementById("service_name").addEventListener("input", function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, "")  // remove special chars
        .replace(/\s+/g, "-")          // spaces → hyphen
        .replace(/-+/g, "-");          // remove multiple hyphens

    document.getElementById("service_slug").value = slug;
});

</body>
</html>
