<?php
include 'db.php'; // database connection

if (isset($_POST['submit'])) {

    $full_name       = $_POST['full_name'];
    $company_name    = $_POST['company_name'];
    $email           = $_POST['email'];
    $phone           = $_POST['phone'];
    $address         = $_POST['address'];
    $website         = $_POST['website'];
    $project_name    = $_POST['project_name'];
    $project_type    = $_POST['project_type'];
    $budget          = $_POST['budget'];
    $deadline        = $_POST['deadline'];
    $design_style    = $_POST['design_style'];
    $reference_links = $_POST['reference_links'];
    $status          = $_POST['status'];
    $priority        = $_POST['priority'];
    $internal_notes  = $_POST['internal_notes'];

    // Technology
    $technology = isset($_POST['technology']) ? implode(",", $_POST['technology']) : "";

    // Upload Logo
    $logo_name = "";
    if (!empty($_FILES['logo']['name'])) {
        $logo_name = time() . "-" . $_FILES['logo']['name'];
        move_uploaded_file($_FILES['logo']['tmp_name'], "uploads/" . $logo_name);
    }

    // Upload Documents
    $document_name = "";
    if (!empty($_FILES['documents']['name'])) {
        $document_name = time() . "-" . $_FILES['documents']['name'];
        move_uploaded_file($_FILES['documents']['tmp_name'], "uploads/" . $document_name);
    }

    // Insert Query
    $query = "
    INSERT INTO clients 
    (full_name, company_name, email, phone, address, website, project_name, project_type, budget, deadline, design_style, technology, reference_links, status, priority, internal_notes, logo, documents)
    VALUES 
    ('$full_name', '$company_name', '$email', '$phone', '$address', '$website', '$project_name', '$project_type', '$budget', '$deadline', '$design_style', '$technology', '$reference_links', '$status', '$priority', '$internal_notes', '$logo_name', '$document_name')
    ";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Client Added Successfully!'); window.location='add-client.php';</script>";
    } else {
        echo "<script>alert('Error while saving data');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Client | CMS Admin</title>
<!-- Bootstrap CSS -->
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

  .form-card {
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    transition: transform 0.3s, box-shadow 0.3s;
  }

  .form-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.1);
  }

  .form-card h3 {
    font-size: 1.3rem;
    margin-bottom: 20px;
    font-weight: 600;
    border-bottom: 2px solid #0d6efd;
    padding-bottom: 5px;
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
    min-height: 80px;
    resize: vertical;
  }

  button[type="submit"] {
    background-color: #0d6efd;
    color: #fff;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    transition: 0.3s;
  }

  button[type="submit"]:hover {
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

<?php include 'sidebar.php' ?>

<div class="container">
  <h2>Add New Client</h2>

  <form action="" method="POST" enctype="multipart/form-data">
    
    <div class="form-card">
      <h3>Client & Project Details</h3>
      <div class="row g-3">
        <!-- Full Name -->
        <div class="col-md-6">
          <label>Full Name <span class="text-danger">*</span></label>
          <input type="text" name="full_name" placeholder="Enter full name" required>
        </div>

        <!-- Company Name -->
        <div class="col-md-6">
          <label>Company Name</label>
          <input type="text" name="company_name" placeholder="Enter company name">
        </div>

        <!-- Email -->
        <div class="col-md-6">
          <label>Email <span class="text-danger">*</span></label>
          <input type="email" name="email" placeholder="Enter email" required>
        </div>

        <!-- Phone -->
        <div class="col-md-6">
          <label>Phone</label>
          <input type="text" name="phone" placeholder="Enter phone number">
        </div>

        <!-- Address -->
        <div class="col-md-6">
          <label>Address</label>
          <textarea name="address" placeholder="Enter address"></textarea>
        </div>

        <!-- Website -->
        <div class="col-md-6">
          <label>Website</label>
          <input type="url" name="website" placeholder="Enter website link">
        </div>

        <!-- Project Name -->
        <div class="col-md-6">
          <label>Project Name</label>
          <input type="text" name="project_name" placeholder="Project title">
        </div>

        <!-- Project Type -->
        <div class="col-md-6">
          <label>Project Type</label>
          <select name="project_type" class="form-select">
            <option value="Website">Website</option>
            <option value="E-commerce">E-commerce</option>
            <option value="Blog">Blog</option>
            <option value="Portfolio">Portfolio</option>
          </select>
        </div>

        <!-- Budget -->
        <div class="col-md-6">
          <label>Budget</label>
          <input type="number" step="0.01" name="budget" placeholder="Estimated budget">
        </div>

        <!-- Deadline -->
        <div class="col-md-6">
          <label>Deadline</label>
          <input type="date" name="deadline">
        </div>

        <!-- Design Style -->
        <div class="col-md-6">
          <label>Design Style</label>
          <select name="design_style" class="form-select">
            <option value="Modern">Modern</option>
            <option value="Minimal">Minimal</option>
            <option value="Corporate">Corporate</option>
            <option value="Colorful">Colorful</option>
          </select>
        </div>

        <!-- Technology -->
        <div class="col-md-6">
          <label>Technology Preferences</label>
          <select name="technology[]" class="form-select" multiple>
            <option value="HTML/CSS">HTML/CSS/JS</option>
            <option value="React">React</option>
            <option value="PHP">PHP</option>
            <option value="python">python</option> 
          </select>
        </div>

        <!-- Reference Website -->
        <div class="col-md-6">
          <label>Reference Websites</label>
          <input type="text" name="reference_links" placeholder="e.g. www.example.com">
        </div>

        <!-- Status -->
        <div class="col-md-6">
          <label>Status</label>
          <select name="status" class="form-select">
            <option value="New">New</option>
            <option value="In Progress">In Progress</option>
            <option value="Completed">Completed</option>
          </select>
        </div>

        <!-- Priority -->
        <div class="col-md-6">
          <label>Priority</label>
          <select name="priority" class="form-select">
            <option value="Low">Low</option>
            <option value="Medium">Medium</option>
            <option value="High">High</option>
          </select>
        </div>

        <!-- Internal Notes -->
        <div class="col-12">
          <label>Internal Notes</label>
          <textarea name="internal_notes" placeholder="Add notes"></textarea>
        </div>

        <!-- Logo Upload -->
        <div class="col-md-6">
          <label>Logo Upload</label>
          <input type="file" name="logo" class="form-control">
        </div>

        <!-- Document Upload -->
        <div class="col-md-6">
          <label>Documents Upload</label>
          <input type="file" name="documents" class="form-control">
        </div>
      </div>

      <div class="mt-4 text-end">
        <button type="submit" name="submit">Add Client</button>
      </div>
    </div>

  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSubmenu(id) {
      const submenu = document.getElementById(id);
      const arrow = document.getElementById("arrow-" + id);
      if (submenu.style.display === "block") {
        submenu.style.display = "none";
        arrow.classList.remove("rotate");
      } else {
        submenu.style.display = "block";
        arrow.classList.add("rotate");
      }
    }
  </script>

</body>
</html>
