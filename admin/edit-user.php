<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: view-user.php");
    exit;
}

$id = (int) $_GET['id'];

/* Fetch user */
$result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found";
    exit;
}

/* Update user */
if (isset($_POST['update'])) {

    $name     = mysqli_real_escape_string($conn, $_POST['name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role     = mysqli_real_escape_string($conn, $_POST['role']);
    $status   = mysqli_real_escape_string($conn, $_POST['status']);

    /* Password update (optional) */
    $password_sql = "";
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $password_sql = ", password='$password'";
    }

    /* Image upload */
    $image = $user['image'];
    if (!empty($_FILES['image']['name'])) {
        $image = time() . "_" . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    $update = "
        UPDATE users SET
            name='$name',
            email='$email',
            phone='$phone',
            username='$username',
            role='$role',
            status='$status',
            image='$image'
            $password_sql
        WHERE id=$id
    ";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('User Updated Successfully'); window.location='view-user.php';</script>";
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit User | CMS Admin</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body { background:#eef1f4; font-family:"Segoe UI", sans-serif; }
.content-wrapper { margin-left:250px; padding:25px; }
.card-custom {
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.08);
}
.profile-preview {
    width:80px;
    height:80px;
    border-radius:50%;
    object-fit:cover;
    margin-top:10px;
}
@media(max-width:992px){
    .content-wrapper { margin-left:0; }
}
</style>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="content-wrapper">
<h3 class="mb-3"><i class="bi bi-pencil-square"></i> Edit User</h3>

<div class="card card-custom p-4">

<form method="POST" enctype="multipart/form-data">
<div class="row g-3">

<div class="col-md-6">
<label>Full Name</label>
<input type="text" class="form-control" name="name" value="<?= $user['name']; ?>" required>
</div>

<div class="col-md-6">
<label>Email</label>
<input type="email" class="form-control" name="email" value="<?= $user['email']; ?>" required>
</div>

<div class="col-md-6">
<label>Phone</label>
<input type="text" class="form-control" name="phone" value="<?= $user['phone']; ?>" required>
</div>

<div class="col-md-6">
<label>Username</label>
<input type="text" class="form-control" name="username" value="<?= $user['username']; ?>" required>
</div>

<div class="col-md-6">
<label>New Password (optional)</label>
<input type="password" class="form-control" name="password" placeholder="Leave blank to keep old">
</div>

<div class="col-md-6">
<label>Role</label>
<select class="form-select" name="role">
<option value="Admin" <?= $user['role']=="Admin"?"selected":""; ?>>Admin</option>
<option value="Editor" <?= $user['role']=="Editor"?"selected":""; ?>>Editor</option>
<option value="Viewer" <?= $user['role']=="Viewer"?"selected":""; ?>>Viewer</option>
</select>
</div>

<div class="col-md-6">
<label>Status</label>
<select class="form-select" name="status">
<option value="Active" <?= $user['status']=="Active"?"selected":""; ?>>Active</option>
<option value="Inactive" <?= $user['status']=="Inactive"?"selected":""; ?>>Inactive</option>
</select>
</div>

<div class="col-md-6">
<label>Profile Image</label>
<input type="file" class="form-control" name="image">
<?php if ($user['image']) { ?>
<img src="uploads/<?= $user['image']; ?>" class="profile-preview">
<?php } ?>
</div>

</div>

<button type="submit" name="update" class="btn btn-primary mt-4">
<i class="bi bi-check-circle"></i> Update User
</button>

<a href="view-user.php" class="btn btn-secondary mt-4 ms-2">
<i class="bi bi-arrow-left"></i> Back
</a>

</form>
</div>
</div>

</body>
</html>
