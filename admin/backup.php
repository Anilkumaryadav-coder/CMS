<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Backup Settings | CMS</title>

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
h2 {
    font-weight: 500;
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 22px; /* medium heading */
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

/* Info badge */
.badge-status{
    font-size:14px;
    padding:8px 14px;
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

/* Manual backup button */
.btn-backup{
    background:#10b981;
    border:none;
    padding:12px 26px;
    border-radius:12px;
    font-weight:600;
    color:#fff;
}
.btn-backup:hover{
    background:#059669;
}
</style>
</head>

<body>

<?php include "sidebar.php"; ?> <!-- Sidebar LEFT -->

<div class="wrapper">

    <!-- CONTENT RIGHT -->
    <main class="content">

        <div class="page-title">Backup Settings</div>

        <div class="form-box">

            <div class="section-title">System Backup Configuration</div>

            <form>
                <div class="row g-4">

                    <!-- Auto Backup -->
                    <div class="col-md-6">
                        <label class="form-label">Auto Backup</label>
                        <div class="form-check form-switch mt-2">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Enable automatic backups</label>
                        </div>
                    </div>

                    <!-- Backup Frequency -->
                    <div class="col-md-6">
                        <label class="form-label">Backup Frequency</label>
                        <select class="form-select">
                            <option>Daily</option>
                            <option>Weekly</option>
                            <option>Monthly</option>
                        </select>
                    </div>

                    <!-- Storage Type -->
                    <div class="col-md-6">
                        <label class="form-label">Storage Type</label>
                        <select class="form-select">
                            <option>Local Storage</option>
                            <option>Cloud Storage</option>
                        </select>
                    </div>

                    <!-- Last Backup -->
                    <div class="col-md-6">
                        <label class="form-label">Last Backup Status</label><br>
                        <span class="badge bg-success badge-status">
                            <i class="bi bi-check-circle"></i> Completed (Today 02:30 AM)
                        </span>
                    </div>

                    <!-- Manual Backup -->
                    <div class="col-md-12">
                        <label class="form-label">Manual Backup</label><br>
                        <button type="button" class="btn btn-backup mt-2">
                            <i class="bi bi-cloud-arrow-up"></i> Run Backup Now
                        </button>
                        <small class="d-block text-muted mt-2">
                            Click to create an immediate system backup
                        </small>
                    </div>

                </div>

                <div class="mt-5 text-end">
                    <button type="button" class="btn btn-save text-white">
                        <i class="bi bi-save"></i> Save Backup Settings
                    </button>
                </div>

            </form>

        </div>

    </main>

</div>

</body>
</html>
