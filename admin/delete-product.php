<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-product.php");
    exit;
}

$id = (int)$_GET['id'];

/* Optional: remove images here */

/* Delete product */
mysqli_query($conn, "DELETE FROM products WHERE id=$id");

header("Location: view-product.php");
exit;
