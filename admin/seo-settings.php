<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>SEO Settings | CMS</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body{
    margin:0;
    background:#f3f6fb;
    font-family:"Segoe UI", sans-serif;
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
.form-select,
textarea{
    border-radius:12px;
    padding:12px 15px;
    border:1px solid #d1d5db;
}
.form-control:focus,
.form-select:focus,
textarea:focus{
    border-color:#2563eb;
    box-shadow:0 0 0 0.15rem rgba(37,99,235,.25);
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

        <div class="page-title">SEO Settings</div>

        <div class="form-box">

            <div class="section-title">Search Engine Optimization</div>

            <form>
                <div class="row g-4">

                    <!-- Meta Title -->
                    <div class="col-md-12">
                        <label class="form-label">Default Meta Title</label>
                        <input type="text" class="form-control" placeholder="My Website | Best Services">
                    </div>

                    <!-- Meta Description -->
                    <div class="col-md-12">
                        <label class="form-label">Default Meta Description</label>
                        <textarea class="form-control" rows="3" placeholder="Write a short SEO-friendly description for your website"></textarea>
                    </div>

                    <!-- Meta Keywords -->
                    <div class="col-md-12">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" class="form-control" placeholder="cms, web development, services">
                        <small class="text-muted">Separate keywords with commas</small>
                    </div>

                    <!-- Google Analytics -->
                    <div class="col-md-6">
                        <label class="form-label">Google Analytics ID</label>
                        <input type="text" class="form-control" placeholder="G-XXXXXXXXXX">
                    </div>

                    <!-- Search Console -->
                    <div class="col-md-6">
                        <label class="form-label">Search Console Code</label>
                        <input type="text" class="form-control" placeholder="google-site-verification code">
                    </div>

                    <!-- Robots Meta -->
                    <div class="col-md-6">
                        <label class="form-label">Robots Meta</label>
                        <select class="form-select">
                            <option value="index, follow">Index, Follow</option>
                            <option value="noindex, follow">No Index, Follow</option>
                            <option value="index, nofollow">Index, No Follow</option>
                            <option value="noindex, nofollow">No Index, No Follow</option>
                        </select>
                    </div>

                </div>

                <div class="mt-5 text-end">
                    <button type="button" class="btn btn-save text-white">
                        <i class="bi bi-save"></i> Save SEO Settings
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
