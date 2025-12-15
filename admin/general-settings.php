<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>General Settings | CMS</title>

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

/* Sidebar (left) */
.sidebar{
    width:260px;
    background:#1f2937;
    color:#fff;
    padding:25px 20px;
    position:fixed;
    top:0;
    left:0;
    height:100vh;
}

/* Content (right) */
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

<?php include "sidebar.php"; ?> <!-- Sidebar on LEFT -->

<div class="wrapper">

    <!-- CONTENT RIGHT -->
    <main class="content">

        <div class="page-title">General Settings</div>

        <div class="form-box">

            <div class="section-title">Website Configuration</div>

            <form>
                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">Site Title</label>
                        <input type="text" class="form-control" placeholder="My Website">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Tagline</label>
                        <input type="text" class="form-control" placeholder="Just another CMS website">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Admin Email</label>
                        <input type="email" class="form-control" placeholder="admin@example.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Contact Phone</label>
                        <input type="text" class="form-control" placeholder="+91 98765 43210">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Website URL</label>
                        <input type="url" class="form-control" placeholder="https://example.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Timezone</label>
                        <select class="form-select">
                            <option>Asia/Kolkata</option>
                            <option>UTC</option>
                            <option>America/New_York</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Date Format</label>
                        <select class="form-select">
                            <option>DD-MM-YYYY</option>
                            <option>YYYY-MM-DD</option>
                            <option>Mon DD, YYYY</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Site Status</label>
                        <select class="form-select">
                            <option>Online</option>
                            <option>Maintenance</option>
                        </select>
                    </div>

                </div>

                <div class="mt-5 text-end">
                    <button type="button" class="btn btn-save text-white">
                        <i class="bi bi-save"></i> Save Settings
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
