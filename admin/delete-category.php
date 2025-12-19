<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-category.php");
    exit;
}

$id = (int) $_GET['id'];

/* Optional: delete images */
$result = mysqli_query($conn, "SELECT category_image, thumbnail FROM categories WHERE id=$id");
if ($row = mysqli_fetch_assoc($result)) {
    if (!empty($row['category_image']) && file_exists("uploads/".$row['category_image'])) {
        unlink("uploads/".$row['category_image']);
    }
    if (!empty($row['thumbnail']) && file_exists("uploads/".$row['thumbnail'])) {
        unlink("uploads/".$row['thumbnail']);
    }
}

/* Delete record */
mysqli_query($conn, "DELETE FROM categories WHERE id=$id");

header("Location: view-category.php");
exit;
