<?php
include "db.php";

if (!isset($_GET['id'])) {
    header("Location: view-user.php");
    exit;
}

$id = (int) $_GET['id'];

/* Fetch image */
$result = mysqli_query($conn, "SELECT image FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);

/* Delete image file */
if ($user && !empty($user['image'])) {
    $path = "uploads/" . $user['image'];
    if (file_exists($path)) {
        unlink($path);
    }
}

/* Delete user */
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

echo "<script>
            alert('Failed to delete page');
            window.location.href='view-user.php';
          </script>";
exit;
