<?php
include "db.php";

/* =============================
   VALIDATE PAGE ID
============================= */
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: view-pages.php");
    exit;
}

$id = (int) $_GET['id'];

/* =============================
   FETCH PAGE DATA
============================= */
$result = mysqli_query($conn, "SELECT * FROM pages WHERE id = $id");
$page = mysqli_fetch_assoc($result);

if (!$page) {
    echo "Page not found!";
    exit;
}

/* =============================
   UPDATE PAGE
============================= */
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $slug  = mysqli_real_escape_string($conn, $_POST['slug']);

    // IMPORTANT: do NOT escape HTML content
    $content = $_POST['content'];

    $meta_title       = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords    = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $video_url        = mysqli_real_escape_string($conn, $_POST['video_url']);
    $banner_title     = mysqli_real_escape_string($conn, $_POST['banner_title']);
    $banner_subtitle  = mysqli_real_escape_string($conn, $_POST['banner_subtitle']);
    $template         = mysqli_real_escape_string($conn, $_POST['template']);
    $display_order    = (int) $_POST['display_order'];
    $status           = mysqli_real_escape_string($conn, $_POST['status']);

    /* =============================
       IMAGE UPLOAD
    ============================= */
    $featured_image = $page['featured_image'];

    if (!empty($_FILES['featured_image']['name'])) {
        $imgName = time() . "_" . basename($_FILES['featured_image']['name']);
        move_uploaded_file($_FILES['featured_image']['tmp_name'], "../uploads/" . $imgName);
        $featured_image = $imgName;
    }

    /* =============================
       UPDATE QUERY
    ============================= */
    $update = "
        UPDATE pages SET
            title='$title',
            slug='$slug',
            content='$content',
            featured_image='$featured_image',
            meta_title='$meta_title',
            meta_description='$meta_description',
            meta_keywords='$meta_keywords',
            video_url='$video_url',
            banner_title='$banner_title',
            banner_subtitle='$banner_subtitle',
            template='$template',
            display_order='$display_order',
            status='$status'
        WHERE id=$id
    ";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Page Updated Successfully'); window.location='view-page.php';</script>";
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Page | CMS Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Summernote -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body {
    background: #eef1f4;
    font-family: Arial, sans-serif;
}

.content-wrapper {
    margin-left: 250px;
    padding: 30px;
}

.form-container {
    max-width: 900px;
    margin: auto;
    background: #fff;
    padding: 30px 40px;
    border-radius: 10px;
    box-shadow: 0 0 12px rgba(0,0,0,0.1);
}

h2 {
    font-weight: 600;
    margin-bottom: 25px;
}

label {
    font-weight: 600;
    margin-top: 15px;
}

.btn-save {
    background: #0d6efd;
    color: #fff;
    padding: 12px 25px;
    border-radius: 6px;
    border: none;
    margin-top: 25px;
}

.btn-save:hover {
    background: #084298;
}

.preview-img {
    margin-top: 10px;
    border-radius: 6px;
    border: 1px solid #ddd;
}

@media (max-width: 992px) {
    .content-wrapper {
        margin-left: 0;
    }
}
</style>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="content-wrapper">
<div class="form-container">

<h2>Edit Page</h2>

<form method="POST" enctype="multipart/form-data">

    <label>Page Title</label>
    <input type="text" class="form-control" name="title" id="title"
           value="<?= htmlspecialchars($page['title']); ?>" required>

    <label>Slug</label>
    <input type="text" class="form-control" name="slug" id="slug"
           value="<?= htmlspecialchars($page['slug']); ?>" required>

    <label>Content</label>
    <textarea id="content" name="content"><?= $page['content']; ?></textarea>

    <label>Featured Image</label>
    <input type="file" class="form-control" name="featured_image">

    <?php if ($page['featured_image']) { ?>
        <img src="../uploads/<?= $page['featured_image']; ?>" class="preview-img" width="150">
    <?php } ?>

    <label>Meta Title</label>
    <input type="text" class="form-control" name="meta_title"
           value="<?= htmlspecialchars($page['meta_title']); ?>">

    <label>Meta Description</label>
    <textarea class="form-control" name="meta_description"><?= htmlspecialchars($page['meta_description']); ?></textarea>

    <label>Meta Keywords</label>
    <input type="text" class="form-control" name="meta_keywords"
           value="<?= htmlspecialchars($page['meta_keywords']); ?>">

    <label>YouTube Video URL</label>
    <input type="text" class="form-control" name="video_url"
           value="<?= htmlspecialchars($page['video_url']); ?>">

    <label>Banner Title</label>
    <input type="text" class="form-control" name="banner_title"
           value="<?= htmlspecialchars($page['banner_title']); ?>">

    <label>Banner Subtitle</label>
    <input type="text" class="form-control" name="banner_subtitle"
           value="<?= htmlspecialchars($page['banner_subtitle']); ?>">

    <label>Template</label>
    <select class="form-control" name="template">
        <option value="default" <?= $page['template']=="default"?"selected":""; ?>>Default</option>
        <option value="landing" <?= $page['template']=="landing"?"selected":""; ?>>Landing</option>
        <option value="sidebar" <?= $page['template']=="sidebar"?"selected":""; ?>>Sidebar</option>
    </select>

    <label>Display Order</label>
    <input type="number" class="form-control" name="display_order"
           value="<?= $page['display_order']; ?>">

    <label>Status</label>
    <select class="form-control" name="status">
        <option value="draft" <?= $page['status']=="draft"?"selected":""; ?>>Draft</option>
        <option value="published" <?= $page['status']=="published"?"selected":""; ?>>Published</option>
    </select>

    <button type="submit" class="btn-save">Update Page</button>

</form>

</div>
</div>

<script>
$('#content').summernote({
    height: 350,
    dialogsInBody: true,
    toolbar: [
        ['style', ['bold', 'italic', 'underline']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['insert', ['link', 'picture']],
        ['view', ['codeview']]
    ]
});

// Auto slug
$('#title').keyup(function () {
    let slug = $(this).val().toLowerCase().replace(/[^a-z0-9]+/g, '-');
    $('#slug').val(slug);
});

if ($update) {
    echo "<script>
            alert('Page updated successfully');
            window.location.href='view-page.php';
          </script>";
}

</script>

</body>
</html>
