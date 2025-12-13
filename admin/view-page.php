<?php
include "db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Pages | CMS Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/cms/css/styles.css">
    <style>
        body { background: #eef1f4; font-family: Arial; }
        .content-wrapper { margin-left: 250px; padding: 30px; }
        h2 { font-weight: 600; margin-bottom: 20px; color:#333; }
        .table thead th { background: #007bff; color:#fff; }
    </style>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="content-wrapper">
    <h2>All Pages</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Template</th>
                    <th>Display Order</th>
                    <th>Featured Image</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <!-- IMPORTANT: tbody must be inside table -->
            <tbody>
            <?php
            $sql = "SELECT * FROM pages ORDER BY display_order ASC, id DESC";
            $result = mysqli_query($conn, $sql);
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                $img = $row['featured_image'] ? "uploads/" . $row['featured_image'] : "no-image.png";

                echo "
                <tr>
                    <td>{$i}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['slug']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['template']}</td>
                    <td>{$row['display_order']}</td>
                    <td><img src='{$img}' width='80' style='border-radius:5px;'></td>
                    <td>
                        <a href='edit-page.php?id={$row['id']}' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='delete-page.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Delete this page?')\">Delete</a>
                        <a href='../{$row['slug']}' class='btn btn-sm btn-success' target='_blank'>View</a>
                    </td>
                </tr>";
                $i++;
            }
            ?>
            </tbody>

        </table>
    </div>
</div>

</body>
</html>
