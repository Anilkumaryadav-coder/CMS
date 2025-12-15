<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-client.php");
    exit;
}

$id = intval($_GET['id']);

$query = "DELETE FROM clients WHERE id=$id";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Client Deleted Successfully'); window.location='view-client.php';</script>";
} else {
    echo "<script>alert('Delete Failed'); window.location='view-client.php';</script>";
}
?>
