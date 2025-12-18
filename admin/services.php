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

/* Fetch categories */
$catResult = mysqli_query(
    $conn,
    "SELECT id, category_name 
     FROM categories 
     WHERE status = 1 
     ORDER BY display_order ASC"
);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // BASIC DATA
    $service_name       = $_POST['service_name'];
    $client = $_POST['client'];
    $service_title      = $_POST['service_title'];
    $service_slug       = $_POST['service_slug'];
    $category = $_POST['category_id'];

    $short_description  = $_POST['short_description'];
    $long_description   = $_POST['long_description'];

    $status        = $_POST['status'];
    $featured      = $_POST['featured'];
    $display_order = $_POST['display_order'];

    $price     = $_POST['price'];
    $duration  = $_POST['duration'];
    $cta_text  = $_POST['cta_text'];

    $meta_title       = $_POST['meta_title'];
    $meta_keywords    = $_POST['meta_keywords'];
    $meta_description = $_POST['meta_description'];

    $youtube_url     = $_POST['youtube_url'];
    $banner_title    = $_POST['banner_title'];
    $banner_subtitle = $_POST['banner_subtitle'];
    $template        = $_POST['template'];
    $faq             = $_POST['faq'];

    // IMAGE UPLOAD FUNCTION
    function uploadImage($fileInput) {
        if (!empty($_FILES[$fileInput]['name'])) {
            $filename = time() . '_' . $_FILES[$fileInput]['name'];
            $path = "../uploads/services/" . $filename;
            move_uploaded_file($_FILES[$fileInput]['tmp_name'], $path);
            return $filename;
        }
        return NULL;
    }

    $image_1 = uploadImage('service_image_1');
    $image_2 = uploadImage('service_image_2');
    $image_3 = uploadImage('service_image_3');
    $image_4 = uploadImage('service_image_4');

    // INSERT QUERY
    $sql = "INSERT INTO services (
        client,service_name, service_title, service_slug, category,
        short_description, long_description,
        image_1, image_2, image_3, image_4,
        status, featured, display_order,
        price, duration, cta_text,
        meta_title, meta_keywords, meta_description,
        youtube_url, banner_title, banner_subtitle,
        template, faq
    ) VALUES (
        '$client','$service_name', '$service_title', '$service_slug', '$category',
        '$short_description', '$long_description',
        '$image_1', '$image_2', '$image_3', '$image_4',
        '$status', '$featured', '$display_order',
        '$price', '$duration', '$cta_text',
        '$meta_title', '$meta_keywords', '$meta_description',
        '$youtube_url', '$banner_title', '$banner_subtitle',
        '$template', '$faq'
    )";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Service Added Successfully'); window.location='view-services.php';</script>";
    } else {
        die("Insert Failed: " . mysqli_error($conn));
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Service</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<!-- Custom CSS -->
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body {
    background: #f5f7fa;
}

/* main layout fix when sidebar exists */
.main-container {
    margin-left: 260px; /* match sidebar width */
    padding: 30px 15px;
}

.page-wrapper {
    display: flex;
    justify-content: center;
}

.service-card {
    width: 100%;
    max-width: 1100px;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    padding: 35px;
}

.section-title {
    font-size: 18px;
    font-weight: 600;
    margin: 35px 0 18px;
    padding-bottom: 8px;
    border-bottom: 2px dashed #e5e7eb;
}

.form-control, .form-select {
    border-radius: 10px;
}

textarea {
    resize: vertical;
}

.image-box {
    border: 1px dashed #cbd5e1;
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    background: #f8fafc;
}

.image-box i {
    font-size: 28px;
    color: #64748b;
}

@media (max-width: 991px) {
    .main-container {
        margin-left: 0;
    }
}
</style>
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main-container">
    <!-- CLIENTS SECTION -->
<div class="col-md-6">
    <label class="form-label">Client *</label>
    <select name="client" class="form-select" required>
        <option value="">-- Select Client --</option>
        <?php foreach ($clients as $client) { ?>
            <option value="<?= $client['id']; ?>">
                <?= htmlspecialchars($client['full_name']); ?>
                <?php if (!empty($client['company_name'])) { ?>
                    (<?= htmlspecialchars($client['company_name']); ?>)
                <?php } ?>
            </option>
        <?php } ?>
    </select>
</div>

    <div class="page-wrapper">
        <div class="service-card">
            <h3 class="mb-4 text-center">Add Service</h3>

            <form action="services.php" method="post" enctype="multipart/form-data">
                <!-- BASIC DETAILS -->
                <div class="section-title">Basic Details</div>
                <div class="row g-4">
                    <div class="row g-4">
    <!-- SERVICE NAME -->
    <div class="col-md-6">
        <label class="form-label">Service Name *</label>
        <input
            type="text"
            name="service_name"
            id="service_name"
            class="form-control"
            placeholder="Enter service name"
            required
        >
    </div>
                    <div class="col-md-6">
                        <label class="form-label">Service Title *</label>
                        <input type="text" name="service_title" class="form-control" required>
                    </div>

                    <!-- SERVICE SLUG -->
    <div class="col-md-6">
        <label class="form-label">Service Slug *</label>
        <input
            type="text"
            name="service_slug"
            id="service_slug"
            class="form-control"
            placeholder="seo-friendly-url"
            required
        >
        <small class="text-muted">
            Auto-generated from service name (you can edit manually)
        </small>
    </div>
                    <div class="col-md-6">
                  <label class="form-label">Category</label>
                  <select name="category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>

                    <?php while ($cat = mysqli_fetch_assoc($catResult)) { ?>
                        <option value="<?= $cat['id']; ?>">
                            <?= htmlspecialchars($cat['category_name']); ?>
                        </option>
                    <?php } ?>

                </select>
            </div>

                    <div class="col-md-6">
                        <label class="form-label">Short Description *</label>
                        <textarea name="short_description" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Detailed Description *</label>
                        <textarea name="long_description" class="form-control" rows="3" required></textarea>
                    </div>
                </div>

                <!-- SERVICE IMAGES -->
                <div class="section-title">Service Images</div>
                <div class="row g-4">
                    <div class="col-md-3 col-sm-6">
                        <div class="image-box">
                            <i class="bi bi-image"></i>
                            <p class="mt-2 mb-2">Image 1 *</p>
                            <input type="file" name="service_image_1" class="form-control" required accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="image-box">
                            <i class="bi bi-image"></i>
                            <p class="mt-2 mb-2">Image 2 *</p>
                            <input type="file" name="service_image_2" class="form-control" required accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="image-box">
                            <i class="bi bi-image"></i>
                            <p class="mt-2 mb-2">Image 3 *</p>
                            <input type="file" name="service_image_3" class="form-control" required accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <div class="image-box">
                            <i class="bi bi-image"></i>
                            <p class="mt-2 mb-2">Image 4</p>
                            <input type="file" name="service_image_4" class="form-control" accept="image/*">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status *</label>
                        <select name="status" class="form-select" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Featured Service</label>
                        <select name="featured" class="form-select">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Display Order</label>
                        <input type="number" name="display_order" class="form-control">
                    </div>
                </div>

                <!-- PRICING & CTA -->
                <div class="section-title">Pricing & CTA</div>
                <div class="row g-4">
                    <div class="col-md-4">
                        <label class="form-label">Price / Starting From</label>
                        <input type="text" name="price" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Duration</label>
                        <input type="text" name="duration" class="form-control" placeholder="e.g. 7 Days">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Call To Action Text</label>
                        <input type="text" name="cta_text" class="form-control" placeholder="Get Quote">
                    </div>
                </div>

                <!-- SEO -->
                <div class="section-title">SEO Settings</div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">SEO Meta Title</label>
                        <input type="text" name="meta_title" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">SEO Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <!-- MEDIA & EXTRA -->
                <div class="section-title">Media & Extra Content</div>
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="form-label">YouTube Video URL</label>
                        <input type="url" name="youtube_url" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Banner Title</label>
                        <input type="text" name="banner_title" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Banner Subtitle</label>
                        <input type="text" name="banner_subtitle" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Template Selector</label>
                        <select name="template" class="form-select">
                            <option value="default">Default</option>
                            <option value="template-1">Template 1</option>
                            <option value="template-2">Template 2</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">FAQ Section</label>
                        <textarea name="faq" class="form-control" rows="3" placeholder="Q: ... A: ..."></textarea>
                    </div>
                </div>

                <!-- SUBMIT -->
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-save"></i> Save Service
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<script>
document.getElementById("service_name").addEventListener("input", function () {
    let slug = this.value
        .toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, "")  // remove special chars
        .replace(/\s+/g, "-")          // spaces → hyphen
        .replace(/-+/g, "-");          // remove multiple hyphens

    document.getElementById("service_slug").value = slug;
});
</script>

</body>
</body>
</html>
