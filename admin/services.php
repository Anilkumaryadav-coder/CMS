<?php
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $client_id = $_POST['client_id'];
    $category_id = $_POST['category_id'];
    $service_name = $_POST['service_name'];
    $slug = $_POST['slug'];
    $service_title = $_POST['service_title'];
    $short_desc = $_POST['short_description'];
    $long_desc = $_POST['long_description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $display_order = $_POST['display_order'];
    $featured = $_POST['featured'];
    $status = $_POST['status'];
    $cta_text = $_POST['cta_text'];

    // File upload (example for one image)
    $image1 = "";
    if (!empty($_FILES['image1']['name'])) {
        $image1 = time().'_'.$_FILES['image1']['name'];
        move_uploaded_file($_FILES['image1']['tmp_name'], ".../uploads/services/".$image1);
    }

    $sql = "INSERT INTO services 
    (client_id, category_id, service_name, slug, service_title,
     short_description, long_description, price, duration,
     display_order, featured, status, cta_text, image1)
    VALUES
    ('$client_id', '$category_id', '$service_name', '$slug', '$service_title',
     '$short_desc', '$long_desc', '$price', '$duration',
     '$display_order', '$featured', '$status', '$cta_text', '$image1')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Service Added Successfully'); window.location='view-services.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
/* Fetch clients */
$clients = [];
$clientQuery = mysqli_query($conn, "SELECT id, full_name, company_name FROM clients ORDER BY full_name ASC");
if ($clientQuery) {
    while ($row = mysqli_fetch_assoc($clientQuery)) {
        $clients[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Service | CMS Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
body {
  background-color: #f2f6fa;
  font-family: 'Segoe UI', sans-serif;
}

.container {
  margin-left: 270px;
  padding: 30px;
}

h2 {
  font-weight: 700;
  margin-bottom: 30px;
  color: #0d6efd;
}

/* CARD */
.form-card {
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 12px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.05);
  margin-bottom: 22px;
  transition: 0.3s;
}

.form-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 25px rgba(0,0,0,0.08);
}

.form-card h3 {
  font-size: 1.25rem;
  margin-bottom: 20px;
  font-weight: 600;
  border-bottom: 2px solid #0d6efd;
  padding-bottom: 6px;
  color: #0d6efd;
}

label {
  font-weight: 500;
}

input, select, textarea {
  width: 100%;
  padding: 10px 12px;
  border-radius: 8px;
  border: 1px solid #ced4da;
  margin-bottom: 15px;
  transition: 0.3s;
}

input:focus, select:focus, textarea:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 8px rgba(13,110,253,0.3);
  outline: none;
}

textarea {
  resize: vertical;
}

button {
  background-color: #0d6efd;
  color: #fff;
  padding: 12px 28px;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  transition: 0.3s;
}

button:hover {
  background-color: #0b5ed7;
  transform: translateY(-2px);
}

@media (max-width: 768px) {
  .container {
    margin-left: 0;
    padding: 20px;
  }
}
</style>
</head>

<body>

<?php include 'sidebar.php'; ?>

<div class="container">

<!-- CLIENTS SECTION -->
<h2 style="margin-bottom:15px;">Select Client</h2>

<label>Client</label>
<select name="client_id" class="form-control" required>
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
  <h2>Add New Service</h2>

  <form method="POST" enctype="multipart/form-data">


    <!-- BASIC INFO -->
    <div class="form-card">
      <h3>Service Basic Information</h3>
      <div class="row g-3">

      <div class="col-md-6">
  <label>Service Name *</label>
  <input type="text" 
         id="service_name" 
         name="service_name"
         placeholder="Web Development" 
         required>
</div>

<div class="col-md-6">
  <label>Service Slug *</label>
  <input type="text" 
         id="service_slug" 
         name="slug"
         placeholder="web-development" 
         required>
</div>

        <div class="col-md-6">
          <label>Service Title *</label>
          <input type="text" placeholder="Professional Web Development Services">
        </div>

        <div class="col-md-6">
          <label>Category</label>
          <select>
            <option>General</option>
            <option>Design</option>
            <option>Development</option>
            <option>Marketing</option>
          </select>
        </div>

        <div class="col-md-12">
          <label>Short Description *</label>
          <textarea placeholder="Short summary of the service"></textarea>
        </div>

        <div class="col-md-12">
          <label>Detailed Description *</label>
          <textarea rows="4" placeholder="Full service description"></textarea>
        </div>

      </div>
    </div>

    <!-- PRICING & DISPLAY -->
    <div class="form-card">
      <h3>Pricing & Display</h3>
      <div class="row g-3">

        <div class="col-md-4">
          <label>Starting Price</label>
          <input type="text" placeholder="₹10,000">
        </div>

        <div class="col-md-4">
          <label>Duration</label>
          <input type="text" placeholder="7 – 10 Days">
        </div>

        <div class="col-md-4">
          <label>Display Order</label>
          <input type="number" placeholder="1">
        </div>

        <div class="col-md-4">
          <label>Featured Service</label>
          <select>
            <option>No</option>
            <option>Yes</option>
          </select>
        </div>

        <div class="col-md-4">
          <label>Status *</label>
          <select>
            <option>Active</option>
            <option>Inactive</option>
          </select>
        </div>

        <div class="col-md-4">
          <label>Call To Action Text</label>
          <input type="text" placeholder="Get Quote / Contact Us">
        </div>

      </div>
    </div>

    <!-- MEDIA -->
    <div class="form-card">
      <h3>Media</h3>
      <div class="row g-3">

        <div class="col-md-6">
          <label>Service Image / Icon *</label>
          <input type="file">
          <input type="file">
          <input type="file">
        </div>

        <div class="col-md-6">
          <label>YouTube Video URL</label>
          <input type="url" placeholder="https://youtube.com/...">
        </div>

        <div class="col-md-6">
          <label>Banner Title</label>
          <input type="text" placeholder="Grow Your Business">
        </div>

        <div class="col-md-6">
          <label>Banner Subtitle</label>
          <input type="text" placeholder="With Our Expert Services">
        </div>

      </div>
    </div>

    <!-- SEO -->
    <div class="form-card">
      <h3>SEO Settings</h3>
      <div class="row g-3">

        <div class="col-md-4">
          <label>Meta Title</label>
          <input type="text">
        </div>

        <div class="col-md-4">
          <label>Meta Keywords</label>
          <input type="text">
        </div>

        <div class="col-md-4">
          <label>Meta Description</label>
          <textarea rows="1"></textarea>
        </div>

      </div>
    </div>

    <!-- EXTRA -->
    <div class="form-card">
      <h3>Extra Settings</h3>
      <div class="row g-3">

        <div class="col-md-6">
          <label>Template Selector</label>
          <select>
            <option>Default</option>
            <option>Landing Page</option>
            <option>Full Width</option>
          </select>
        </div>

        <div class="col-md-6">
          <label>FAQ Section</label>
          <textarea rows="3" placeholder="Q1: ..."></textarea>
        </div>

      </div>
    </div>

    <!-- SUBMIT -->
    <div class="text-end">
      <button type="submit">
        <i class="bi bi-save"></i> Save Service
      </button>
    </div>

  </form>
</div>
<script>
document.getElementById("service_name").addEventListener("keyup", function () {
    let text = this.value;

    let slug = text
        .toLowerCase()                 // lowercase
        .trim()                        // remove spaces
        .replace(/&/g, "and")          // replace &
        .replace(/[^a-z0-9]+/g, "-")   // remove special chars
        .replace(/-+/g, "-")           // remove multiple -
        .replace(/^-|-$/g, "");        // trim - from start/end

    document.getElementById("service_slug").value = slug;
});
</script>

</body>
</html>
