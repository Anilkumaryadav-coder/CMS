<?php
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: view-services.php");
    exit;
}

$id = (int)$_GET['id'];

/* Fetch images */
$result = mysqli_query($conn, "SELECT image_1,image_2,image_3,image_4 FROM services WHERE id=$id");
$row = mysqli_fetch_assoc($result);

/* Delete images */
foreach ($row as $img) {
    if (!empty($img) && file_exists("../uploads/services/".$img)) {
        unlink("../uploads/services/".$img);
    }
}

/* Delete record */
mysqli_query($conn, "DELETE FROM services WHERE id=$id");

header("Location: view-services.php");
exit;
