<?php
include "db.php";

$success = ""; // message variable

if (isset($_POST['submit'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];
    $status = $_POST['status'];

    // IMAGE UPLOAD
    $image_name = "";
    if (!empty($_FILES['image']['name'])) {
        $image_name = time() . "_" . $_FILES['image']['name'];
        $target = "../uploads/" . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    // INSERT QUERY
    $sql = "INSERT INTO users (name, email, phone, username, password, role, status, image)
            VALUES ('$name', '$email', '$phone', '$username', '$password', '$role', '$status', '$image_name')";

    if (mysqli_query($conn, $sql)) {
        $success = "User added successfully!";
    } else {
        $success = "SQL Error: " . mysqli_error($conn);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add User | CMS Admin</title>

<!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
   <!-- Custom CSS -->
  <link rel="stylesheet" href="/cms/css/styles.css">
<style>
    body {
        background-color: #eef1f4;
        font-family: "Segoe UI", sans-serif;
        margin: 0;
        padding: 0;
    }

    
    /* Adjust this width to match your actual sidebar width */
    .content-wrapper {
        margin-left: 250px; /* IMPORTANT: Matches sidebar width */
        padding: 25px;
    }

    .page-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    label {
        font-weight: 500;
    }

    .btn-primary {
        padding: 10px 22px;
        font-size: 16px;
        border-radius: 8px;
    }

    /* Responsive Fix */
    @media(max-width: 992px){
        .content-wrapper {
            margin-left: 0;
            padding: 15px;
        }
    }
</style>
</head>

<body>

<?php include "sidebar.php"; ?> <!-- Sidebar stays left -->

<div class="content-wrapper"> <!-- Page content area -->
    
    <h3 class="page-title mb-3">
        <i class="bi bi-person-plus"></i> Add New User
    </h3>

    <div class="card card-custom p-4">

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="row g-3">

                <div class="col-md-6">
                    <label class="form-label">Full Name *</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email address" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Phone *</label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter phone number" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Username *</label>
                    <input type="text" class="form-control" name="username" placeholder="Set a username" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Password *</label>
                    <input type="password" class="form-control" name="password" placeholder="Create password" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Role *</label>
                    <select class="form-select" name="role" required>
                        <option value="">-- Select Role --</option>
                        <option value="Admin">Admin</option>
                        <option value="Editor">Editor</option>
                        <option value="Viewer">Viewer</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status *</label>
                    <select class="form-select" name="status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Profile Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" name="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Add User
                </button>
            </div>
        </form>

    </div>
</div>
<?php if ($success != ""): ?>
    <div class="alert alert-success text-center fw-bold">
        <?= $success ?>
    </div>
<?php endif; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
