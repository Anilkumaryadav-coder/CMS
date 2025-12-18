<?php
include "db.php";


/* Fetch clients */
$clients = [];
$clientQuery = mysqli_query($conn, "SELECT id, full_name, company_name, website FROM clients ORDER BY full_name ASC");
if ($clientQuery) {
    while ($row = mysqli_fetch_assoc($clientQuery)) {
        $clients[] = $row;
    }
}


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $slug = mysqli_real_escape_string($conn, $_POST['slug']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    $meta_title = mysqli_real_escape_string($conn, $_POST['meta_title']);
    $meta_description = mysqli_real_escape_string($conn, $_POST['meta_description']);
    $meta_keywords = mysqli_real_escape_string($conn, $_POST['meta_keywords']);
    $video_url = mysqli_real_escape_string($conn, $_POST['video_url']);
    $banner_title = mysqli_real_escape_string($conn, $_POST['banner_title']);
    $banner_subtitle = mysqli_real_escape_string($conn, $_POST['banner_subtitle']);
    $template = mysqli_real_escape_string($conn, $_POST['template']);
    $display_order = (int) $_POST['display_order'];
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Image Upload
    $featured_image = NULL;

    if (!empty($_FILES['featured_image']['name'])) {
        $img_name = time() . "_" . basename($_FILES['featured_image']['name']);
        $tmp = $_FILES['featured_image']['tmp_name'];
        move_uploaded_file($tmp, "../uploads/" . $img_name);
        $featured_image = $img_name;
    }

    $sql = "INSERT INTO pages 
    (title, slug, content, featured_image, meta_title, meta_description, meta_keywords, video_url, banner_title, banner_subtitle, template, display_order, status)
    VALUES 
    ('$title', '$slug', '$content', '$featured_image', '$meta_title', '$meta_description', '$meta_keywords', '$video_url', '$banner_title', '$banner_subtitle', '$template', '$display_order', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Page Added Successfully!'); window.location='view-page.php';</script>";
    } else {
        echo "ERROR: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Page | CMS Admin</title>

    <!-- SUMMERNOTE EDITOR -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
     <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="/cms/css/styles.css">
    <style>
       

        /* Match this width to your actual sidebar width */
        .content-wrapper {
            margin-left: 100px; /* Sidebar width */
            padding: 30px;
        }

        .form-container {
            width: 70%;
            margin: auto;
            background: #fff;
            padding: 25px 35px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
   h2 {
    font-weight: 500;
    margin-bottom: 25px;
    color: #0d6efd;
    font-size: 22px; /* medium heading */
}

        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }

        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        .btn-save {
            background: #007bff;
            color: #fff;
            padding: 12px 22px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            margin-top: 25px;
            cursor: pointer;
        }
        .btn-save:hover {
            background: #0056b3;
        }

        .row {
            display: flex;
            gap: 20px;
        }

        .row .col {
            flex: 1;
        }

        /* Responsive Fix */
        @media (max-width: 992px) {
            .content-wrapper {
                margin-left: 0;
                padding: 20px;
            }
            .form-container {
                width: 100%;
            }
            .row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
<!------ Sidebar ------>
<?php include "sidebar.php"; ?> 

<div class="content-wrapper">
    <div class="form-container">
        
<!-- CLIENTS SECTION -->
<h2 style="margin-bottom:15px;">Select Client</h2>

<label>Client</label>
<select name="client_id" class="form-control" required>
    <option value="">-- Select Client --</option>
    <?php foreach ($clients as $client) { ?>
        <option value="<?= $client['id']; ?>">
            <?= htmlspecialchars($client['full_name']); ?>
            <?php if (!empty($client['website'])) { ?>
                (<?= htmlspecialchars($client['website']); ?>)
            <?php } ?>
        </option>
    <?php } ?>
</select>

<hr style="margin:30px 0;">

        <h2>Add New Page</h2>

        <form action="" method="POST" enctype="multipart/form-data">

            <!-- Title -->
            <label>Page Title *</label>
            <input type="text" id="title" name="title" placeholder="Enter page title" required>

            <!-- Slug -->
            <label>URL Slug *</label>
            <input type="text" id="slug" name="slug" placeholder="auto-generated..." required>

            <!-- Content -->
            <label>Page Content *</label>
            <textarea id="content" name="content"></textarea>

            <!-- Featured Image -->
            <label>Featured Image</label>
            <input type="file" name="featured_image">

            <div class="row">
                <div class="col">
                    <!-- SEO Title -->
                    <label>Meta Title</label>
                    <input type="text" name="meta_title" placeholder="SEO title">
                </div>

                <div class="col">
                    <!-- SEO Description -->
                    <label>Meta Description</label>
                    <textarea name="meta_description" rows="3" placeholder="SEO description"></textarea>
                </div>
            </div>

            <!-- Meta Keywords -->
            <label>Meta Keywords</label>
            <input type="text" name="meta_keywords" placeholder="keyword1, keyword2, keyword3">

            <!-- YouTube Video -->
            <label>YouTube Video URL</label>
            <input type="text" name="video_url" placeholder="https://www.youtube.com/embed/...">

            <!-- Banner Title & Subtitle -->
            <label>Banner Title</label>
            <input type="text" name="banner_title">

            <label>Banner Subtitle</label>
            <input type="text" name="banner_subtitle">

            <!-- Template -->
            <label>Page Template</label>
            <select name="template">
                <option value="default">Default</option>
                <option value="landing">Landing Page</option>
                <option value="sidebar">With Sidebar</option>
            </select>

            <!-- Order -->
            <label>Display Order</label>
            <input type="number" name="display_order" value="0">

            <!-- Status -->
            <label>Status</label>
            <select name="status">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>

            <button type="submit" class="btn-save">Save Page</button>
        </form>

    </div>
</div>

<!-- Summernote JS -->
<script>
    $(document).ready(function() {
        $('#content').summernote({
            height: 350,
            placeholder: "Write page content here..."
        });
    });

    // Auto slug
    document.getElementById("title").addEventListener("keyup", function () {
        let text = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-');
        document.getElementById("slug").value = text;
    });
</script>

</body>
</html>
