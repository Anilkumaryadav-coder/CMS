<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-client.php");
    exit;
}

$id = intval($_GET['id']);

// Fetch existing client
$result = mysqli_query($conn, "SELECT * FROM clients WHERE id=$id");
$client = mysqli_fetch_assoc($result);

if (!$client) {
    echo "Client not found";
    exit;
}

// Update client
if (isset($_POST['update'])) {

    $full_name = $_POST['full_name'];
    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $project_name = $_POST['project_name'];
    $status = $_POST['status'];
    $priority = $_POST['priority'];
    $internal_notes = $_POST['internal_notes'];

    $query = "
        UPDATE clients SET
        full_name='$full_name',
        company_name='$company_name',
        email='$email',
        phone='$phone',
        project_name='$project_name',
        status='$status',
        priority='$priority',
        internal_notes='$internal_notes'
        WHERE id=$id
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Client Updated Successfully'); window.location='view-client.php';</script>";
    } else {
        echo "<script>alert('Update Failed');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Client</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="container" style="margin-left:270px; padding:30px;">
<h2 class="mb-4 text-primary">Edit Client</h2>

<form method="POST">
<div class="card p-4 shadow-sm">

<label>Full Name</label>
<input type="text" name="full_name" class="form-control mb-3" value="<?= $client['full_name']; ?>" required>

<label>Company Name</label>
<input type="text" name="company_name" class="form-control mb-3" value="<?= $client['company_name']; ?>">

<label>Email</label>
<input type="email" name="email" class="form-control mb-3" value="<?= $client['email']; ?>" required>

<label>Phone</label>
<input type="text" name="phone" class="form-control mb-3" value="<?= $client['phone']; ?>">

<label>Project Name</label>
<input type="text" name="project_name" class="form-control mb-3" value="<?= $client['project_name']; ?>">

<label>Status</label>
<select name="status" class="form-select mb-3">
<option <?= $client['status']=="New"?"selected":"" ?>>New</option>
<option <?= $client['status']=="In Progress"?"selected":"" ?>>In Progress</option>
<option <?= $client['status']=="Completed"?"selected":"" ?>>Completed</option>
</select>

<label>Priority</label>
<select name="priority" class="form-select mb-3">
<option <?= $client['priority']=="Low"?"selected":"" ?>>Low</option>
<option <?= $client['priority']=="Medium"?"selected":"" ?>>Medium</option>
<option <?= $client['priority']=="High"?"selected":"" ?>>High</option>
</select>

<label>Internal Notes</label>
<textarea name="internal_notes" class="form-control mb-3"><?= $client['internal_notes']; ?></textarea>

<button type="submit" name="update" class="btn btn-primary">Update Client</button>
<a href="view-client.php" class="btn btn-secondary">Cancel</a>

</div>
</form>
</div>

</body>
</html>
