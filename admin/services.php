<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Service | CMS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<!-- Custom CSS -->
  <link rel="stylesheet" href="/cms/css/styles.css">
</head>
<body>


<div class="container mt-4">
<h3>Add New Service</h3>
<?= $msg ?>


<form method="POST" enctype="multipart/form-data">


<!-- Basic Info -->
<div class="card mb-3">
<div class="card-header">Basic Information</div>
<div class="card-body">
<input type="text" name="service_title" class="form-control mb-2" placeholder="Service Title" required>
<input type="text" name="service_slug" class="form-control mb-2" placeholder="Service Slug">
<textarea name="short_description" class="form-control" placeholder="Short Description"></textarea>
</div>
</div>


<!-- Description -->
<div class="card mb-3">
<div class="card-header">Service Description</div>
<div class="card-body">
<textarea name="description" id="editor"></textarea>
</div>
</div>


<!-- Banner -->
<div class="card mb-3">
<div class="card-header">Banner Settings</div>
<div class="card-body">
<input type="text" name="banner_title" class="form-control mb-2" placeholder="Banner Title">
<input type="text" name="banner_subtitle" class="form-control mb-2" placeholder="Banner Subtitle">
<input type="file" name="image" class="form-control">
</div>
</div>


<!-- SEO -->
<div class="card mb-3">
<div class="card-header">SEO Settings</div>
<div class="card-body">
<input type="text" name="seo_title" class="form-control mb-2" placeholder="SEO Title">
<textarea name="meta_description" class="form-control mb-2" placeholder="Meta Description"></textarea>
<textarea name="meta_keywords" class="form-control" placeholder="Meta Keywords"></textarea>
</div>
</div>


<!-- Status -->
<div class="card mb-3">
<div class="card-header">Status</div>
<div class="card-body">
<select name="status" class="form-select">
<option value="Active">Active</option>
<option value="Inactive">Inactive</option>
</select>
</div>
</div>


<button type="submit" name="save_service" class="btn btn-primary">Save Service</button>
</form>
</div>


<script>
$('#editor').summernote({ height: 200 });
</script>


</body>
</html>