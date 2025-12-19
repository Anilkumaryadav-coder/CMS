<?php
include "db.php";

if (isset($_POST['save_settings'])) {

    $site_title    = $_POST['site_title'];
    $tagline       = $_POST['tagline'];
    $admin_email   = $_POST['admin_email'];
    $contact_phone = $_POST['contact_phone'];
    $website_url   = $_POST['website_url'];
    $timezone      = $_POST['timezone'];
    $date_format   = $_POST['date_format'];
    $site_status   = $_POST['site_status'];

    $sql = "INSERT INTO general_settings
            (site_title, tagline, admin_email, contact_phone, website_url, timezone, date_format, site_status)
            VALUES
            ('$site_title','$tagline','$admin_email','$contact_phone','$website_url','$timezone','$date_format','$site_status')";

    mysqli_query($conn, $sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>General Settings | CMS</title>

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
.wrapper{
    display:flex;
    min-height:100vh;
}
.content{
    margin-left:260px;
    padding:40px 50px;
    flex:1;
}
.page-title{
    font-size:34px;
    font-weight:700;
    color:#2563eb;
    margin-bottom:25px;
}
.form-box{
    background:#ffffff;
    border-radius:18px;
    padding:35px;
    box-shadow:0 20px 45px rgba(0,0,0,.08);
}
.section-title{
    font-size:22px;
    font-weight:600;
    color:#2563eb;
    border-bottom:2px solid #2563eb;
    padding-bottom:10px;
    margin-bottom:25px;
}
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

<?php include "sidebar.php"; ?>

<div class="wrapper">
<main class="content">

<div class="page-title">General Settings</div>

<div class="form-box">
<div class="section-title">Website Configuration</div>

<form method="post">
<div class="row g-4">

<div class="col-md-6">
<label class="form-label">Site Title</label>
<input type="text" name="site_title" class="form-control" placeholder="My Website">
</div>

<div class="col-md-6">
<label class="form-label">Tagline</label>
<input type="text" name="tagline" class="form-control" placeholder="Just another CMS website">
</div>

<div class="col-md-6">
<label class="form-label">Admin Email</label>
<input type="email" name="admin_email" class="form-control" placeholder="admin@example.com">
</div>

<div class="col-md-6">
<label class="form-label">Contact Phone</label>
<input type="text" name="contact_phone" class="form-control" placeholder="+91 98765 43210">
</div>

<div class="col-md-6">
<label class="form-label">Website URL</label>
<input type="url" name="website_url" class="form-control" placeholder="https://example.com">
</div>

<div class="col-md-6">
<label class="form-label">Timezone</label>
<select name="timezone" class="form-select">
    <option value="Asia/Kolkata">Asia/Kolkata</option>
    <option value="UTC">UTC</option>
    <option value="America/New_York">America/New_York</option>
</select>
</div>

<div class="col-md-6">
<label class="form-label">Date Format</label>
<select name="date_format" class="form-select">
    <option value="DD-MM-YYYY">DD-MM-YYYY</option>
    <option value="YYYY-MM-DD">YYYY-MM-DD</option>
    <option value="Mon DD, YYYY">Mon DD, YYYY</option>
</select>
</div>

<div class="col-md-6">
<label class="form-label">Site Status</label>
<select name="site_status" class="form-select">
    <option value="Online">Online</option>
    <option value="Maintenance">Maintenance</option>
</select>
</div>

</div>

<div class="mt-5 text-end">
<button type="submit" name="save_settings" class="btn btn-save text-white">
<i class="bi bi-save"></i> Save Settings
</button>
</div>

</form>

</div>
</main>
</div>

</body>
</html>
