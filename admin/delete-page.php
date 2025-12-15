<?php
// Database connection
include "db.php";

// If ID not set, go back safely
if (!isset($_GET['id']) || $_GET['id'] == "") {
    header("Location: view-page.php");
    exit;
}

// Secure ID
$id = (int) $_GET['id'];

// Optional: check if record exists
$check = mysqli_query($conn, "SELECT id FROM pages WHERE id = $id");

if (mysqli_num_rows($check) == 0) {
    echo "<script>
            alert('Page not found');
            window.location.href='view-page.php';
          </script>";
    exit;
}

// Delete query
$delete = mysqli_query($conn, "DELETE FROM pages WHERE id = $id");

if ($delete) {
    echo "<script>
            alert('Page deleted successfully');
            window.location.href='view-page.php';
          </script>";
} else {
    echo "<script>
            alert('Failed to delete page');
            window.location.href='view-page.php';
          </script>";
}
?>
