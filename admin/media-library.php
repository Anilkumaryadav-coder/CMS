<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Media Library Settings | CMS</title>

<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <!-- Custom CSS -->
  <link rel="stylesheet" href="/cms/css/styles.css">
<style>
body{
    margin:0;
    background:#f3f6fb;
    font-family:"Segoe UI", sans-serif;
}
h2 {
    font-weight: 500;
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 22px; /* medium heading */
}
/* Layout */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* Content */
.content{
    margin-left:260px;
    padding:40px 50px;
    flex:1;
}

/* Page title */
.page-title{
    font-size:34px;
    font-weight:700;
    color:#2563eb;
    margin-bottom:25px;
}

/* Form container */
.form-box{
    background:#ffffff;
    border-radius:18px;
    padding:35px;
    box-shadow:0 20px 45px rgba(0,0,0,.08);
}

/* Section heading */
.section-title{
    font-size:22px;
    font-weight:600;
    color:#2563eb;
    border-bottom:2px solid #2563eb;
    padding-bottom:10px;
    margin-bottom:25px;
}

/* Inputs */
.form-label{
    font-weight:600;
    color:#374151;
}
.form-control,
.form-select{
    border-radius:12px;
    padding:12px 15px;
    border:1px solid #d1d5db;
}
.form-control:focus,
.form-select:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 0.15rem rgba(37,99,235,.25);
}

/* Toggle */
.form-switch .form-check-input{
    width:3em;
    height:1.5em;
    cursor:pointer;
}

/* Save button */
.btn-save{
    background:#2563eb;
    border:none;
    padding:12px 30px;
    border-radius:12px;
    font-weight:600;
    font-size:16px;
}
.btn-save:hover{
    background:#1d4ed8;
}
</style>
</head>

<body>

<?php include "sidebar.php"; ?> <!-- Sidebar LEFT -->

<div class="wrapper">

    <!-- CONTENT RIGHT -->
    <main class="content">

        <div class="page-title">Media Library Settings</div>

        <div class="form-box">

            <div class="section-title">Upload & Media Configuration</div>

            <form>
                <div class="row g-4">

                    <!-- Max Upload Size -->
                    <div class="col-md-6">
                        <label class="form-label">Max Upload Size (MB)</label>
                        <input type="number" class="form-control" placeholder="10">
                        <small class="text-muted">Maximum allowed file size</small>
                    </div>

                    <!-- Allowed File Types -->
                    <div class="col-md-6">
                        <label class="form-label">Allowed File Types</label>
                        <input type="text" class="form-control" placeholder="jpg, png, pdf">
                        <small class="text-muted">Separate file types using commas</small>
                    </div>

                    <!-- Image Quality -->
                    <div class="col-md-6">
                        <label class="form-label">Image Quality (%)</label>
                        <input type="number" class="form-control" placeholder="80">
                        <small class="text-muted">Controls image compression level</small>
                    </div>

                    <!-- Auto Resize -->
                    <div class="col-md-6">
                        <label class="form-label">Auto Resize Images</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Enable automatic resizing</label>
                        </div>
                    </div>

                    <!-- Storage Path -->
                    <div class="col-md-12">
                        <label class="form-label">Storage Path</label>
                        <input type="text" class="form-control" placeholder="/uploads/media/">
                        <small class="text-muted">Server directory for uploaded files</small>
                    </div>

                </div>

                <div class="mt-5 text-end">
                    <button type="button" class="btn btn-save text-white">
                        <i class="bi bi-save"></i> Save Media Settings
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
