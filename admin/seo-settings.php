<?php
include "db.php";

if (isset($_POST['save_seo'])) {

    $meta_title       = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords    = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $google_analytics = mysqli_real_escape_string($conn, $_POST['google_analytics']);
    $search_console   = mysqli_real_escape_string($conn, $_POST['search_console']);
    $robots_meta      = mysqli_real_escape_string($conn, $_POST['robots_meta']);

    mysqli_query($conn, "INSERT INTO seo_settings
        (meta_title, meta_description, meta_keywords, google_analytics, search_console, robots_meta)
        VALUES
        ('$meta_title','$meta_description','$meta_keywords','$google_analytics','$search_console','$robots_meta')
    ");

    header("Location: seo-settings.php?success=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SEO Settings | CMS</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
/* SAME CSS – NOT TOUCHED */
body{margin:0;background:#f3f6fb;font-family:"Segoe UI", sans-serif;}
.wrapper{display:flex;min-height:100vh;}
.content{margin-left:260px;padding:40px 50px;flex:1;}
.page-title{font-size:34px;font-weight:700;color:#2563eb;margin-bottom:25px;}
.form-box{background:#fff;border-radius:18px;padding:35px;box-shadow:0 20px 45px rgba(0,0,0,.08);}
.section-title{font-size:22px;font-weight:600;color:#2563eb;border-bottom:2px solid #2563eb;padding-bottom:10px;margin-bottom:25px;}
.form-label{font-weight:600;}
.form-control,.form-select,textarea{border-radius:12px;padding:12px;}
.btn-save{background:#2563eb;border:none;padding:12px 30px;border-radius:12px;font-weight:600;}
</style>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="wrapper">
<main class="content">

<div class="page-title">SEO Settings</div>

<?php if(isset($_GET['success'])): ?>
<div class="alert alert-success">SEO Settings Saved Successfully</div>
<?php endif; ?>

<div class="form-box">
<div class="section-title">Search Engine Optimization</div>

<form method="POST">

<div class="row g-4">

<div class="col-md-12">
<label class="form-label">Default Meta Title</label>
<input type="text" name="meta_title" class="form-control" required>
</div>

<div class="col-md-12">
<label class="form-label">Default Meta Description</label>
<textarea name="meta_description" class="form-control" rows="3"></textarea>
</div>

<div class="col-md-12">
<label class="form-label">Meta Keywords</label>
<input type="text" name="meta_keywords" class="form-control">
</div>

<div class="col-md-6">
<label class="form-label">Google Analytics ID</label>
<input type="text" name="google_analytics" class="form-control">
</div>

<div class="col-md-6">
<label class="form-label">Search Console Code</label>
<input type="text" name="search_console" class="form-control">
</div>

<div class="col-md-6">
<label class="form-label">Robots Meta</label>
<select name="robots_meta" class="form-select">
<option value="index, follow">Index, Follow</option>
<option value="noindex, follow">No Index, Follow</option>
<option value="index, nofollow">Index, No Follow</option>
<option value="noindex, nofollow">No Index, No Follow</option>
</select>
</div>

</div>

<div class="mt-5 text-end">
<button type="submit" name="save_seo" class="btn btn-save text-white">
<i class="bi bi-save"></i> Save SEO Settings
</button>
</div>

</form>
</div>
</main>
</div>
</body>
</html>
