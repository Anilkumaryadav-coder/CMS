<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Clients | CMS Admin</title>

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="/cms/css/styles.css">

<style>

/* Main container */
.main-container {
  margin-left: 270px; /* Adjust to sidebar width */
  padding: 30px;
}

h2 {
  font-weight: 700;
  color: #0d6efd;
  text-align: center;
  margin-bottom: 25px;
}

/* Centering card */
.card {
  max-width: 1100px;
  margin: 0 auto;
  border-radius: 12px;
  box-shadow: 0 6px 18px rgba(0,0,0,0.05);
}

.table thead {
  background-color: #0d6efd;
  color: #fff;
}

.table tbody tr:hover {
  background-color: #e9f0ff;
}

/* Filters center */
.filters {
  max-width: 1100px;
  margin: 0 auto 20px auto;
  display: flex;
  gap: 10px;
}

.btn-edit {
  background-color: #0d6efd;
  color: #fff;
  padding: 5px 10px;
  border-radius: 6px;
}

.btn-edit:hover {
  background-color: #0b5ed7;
}

.btn-delete {
  background-color: #dc3545;
  color: #fff;
  padding: 5px 10px;
  border-radius: 6px;
}

.btn-delete:hover {
  background-color: #c82333;
}

/* Mobile */
@media (max-width: 768px) {
  .main-container {
    margin-left: 0;
  }
  .filters {
    flex-direction: column;
  }
}
</style>

</head>
<body>

<!-- Sidebar -->
<?php include 'sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div class="main-container">

  <h2>Clients List</h2>

  <!-- Filters -->
  <div class="filters">
    <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or project">

    <select id="statusFilter" class="form-select">
      <option value="">All Status</option>
      <option value="New">New</option>
      <option value="In Progress">In Progress</option>
      <option value="Completed">Completed</option>
    </select>

    <select id="priorityFilter" class="form-select">
      <option value="">All Priority</option>
      <option value="Low">Low</option>
      <option value="Medium">Medium</option>
      <option value="High">High</option>
    </select>
  </div>

  <!-- Center Card Table -->
  <div class="card p-3">
    <div class="table-responsive">
      <table class="table table-hover align-middle" id="clientsTable">
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Company</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Project</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>
        <?php
        $sql = "SELECT * FROM clients ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $i = 1;

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {

                echo "
                <tr>
                    <td>{$i}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['company_name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['project_name']}</td>
                    <td>{$row['status']}</td>
                    <td>{$row['priority']}</td>

                    <td>
                      <a href='edit-client.php?id={$row['id']}' class='btn btn-edit'>
                        <i class='bi bi-pencil-fill'></i>
                      </a>

                      <a href='delete-client.php?id={$row['id']}' class='btn btn-delete' onclick=\"return confirm('Are you sure?')\">
                        <i class='bi bi-trash-fill'></i>
                      </a>
                    </td>
                </tr>";

                $i++;
            }
        } else {
            echo "<tr><td colspan='9' class='text-center text-danger'>No Clients Found</td></tr>";
        }
        ?>
        </tbody>

      </table>
    </div>
  </div>

</div><!-- container end -->

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Search + Filters
const searchInput = document.getElementById('searchInput');
const statusFilter = document.getElementById('statusFilter');
const priorityFilter = document.getElementById('priorityFilter');
const table = document.getElementById('clientsTable').getElementsByTagName('tbody')[0];

function filterTable() {
  const searchValue = searchInput.value.toLowerCase();
  const statusValue = statusFilter.value;
  const priorityValue = priorityFilter.value;

  Array.from(table.rows).forEach(row => {
    const name = row.cells[1].textContent.toLowerCase();
    const email = row.cells[3].textContent.toLowerCase();
    const project = row.cells[5].textContent.toLowerCase();
    const status = row.cells[6].textContent;
    const priority = row.cells[7].textContent;

    const matchSearch = name.includes(searchValue) || email.includes(searchValue) || project.includes(searchValue);
    const matchStatus = !statusValue || status === statusValue;
    const matchPriority = !priorityValue || priority === priorityValue;

    row.style.display = (matchSearch && matchStatus && matchPriority) ? "" : "none";
  });
}

searchInput.addEventListener("keyup", filterTable);
statusFilter.addEventListener("change", filterTable);
priorityFilter.addEventListener("change", filterTable);
</script>

</body>
</html>
