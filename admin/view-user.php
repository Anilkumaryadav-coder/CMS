<?php
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Users | CMS Admin</title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="/cms/css/styles.css">

<style>
    body {
        background-color: #eef1f4;
        font-family: "Segoe UI", sans-serif;
    }

    .content-wrapper {
        margin-left: 250px;
        padding: 25px;
    }

    .page-title {
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    }

    .profile-img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
    }

    .btn-edit {
        background-color: #0d6efd;
        color: #fff;
        padding: 4px 10px;
        border-radius: 5px;
    }

    .btn-delete {
        background-color: #dc3545;
        color: #fff;
        padding: 4px 10px;
        border-radius: 5px;
    }

    @media(max-width: 992px){
        .content-wrapper { margin-left: 0; }
    }
</style>
</head>

<body>

<?php include "sidebar.php"; ?>

<div class="content-wrapper">

    <h3 class="page-title mb-3">
        <i class="bi bi-people"></i> Users List
    </h3>

    <!-- Search Filter -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search by name, email, or role">
    </div>

    <div class="card card-custom p-3">
        <div class="table-responsive">

            <table class="table table-hover align-middle" id="usersTable">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                $sql = "SELECT * FROM users ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $i = 1;

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysqli_query($conn, $sql) or die("SQL Error: " . mysqli_error($conn));

$i = 1;

if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        $img = $row['image'] ? "uploads/" . $row['image'] : "default.png";

                        echo "
                        <tr>
                            <td>{$i}</td>
                            <td><img src='{$img}' class='profile-img'></td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['phone']}</td>

                            <td>
                                <span class='badge bg-info text-dark'>{$row['role']}</span>
                            </td>

                            <td>
                                <span class='badge " . ($row['status']=="Active" ? "bg-success" : "bg-secondary") . "'>
                                    {$row['status']}
                                </span>
                            </td>

                            <td>
                                <a href='edit-user.php?id={$row['id']}' class='btn-edit'>
                                    <i class='bi bi-pencil'></i>
                                </a>
                                <a href='delete-user.php?id={$row['id']}' class='btn-delete'
                                   onclick=\"return confirm('Are you sure you want to delete this user?')\">
                                    <i class='bi bi-trash'></i>
                                </a>
                            </td>
                        </tr>
                        ";

                        $i++;
                    }

                } else {
                    echo "<tr><td colspan='9' class='text-danger text-center'>No Users Found</td></tr>";
                }
                ?>
                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
// Live Search Filter
const searchInput = document.getElementById("searchInput");
const table = document.getElementById("usersTable").getElementsByTagName("tbody")[0];

searchInput.addEventListener("keyup", function () {
    const value = searchInput.value.toLowerCase();

    Array.from(table.rows).forEach(row => {
        const name = row.cells[2].textContent.toLowerCase();
        const email = row.cells[3].textContent.toLowerCase();
        const role = row.cells[6].textContent.toLowerCase();

        row.style.display =
            (name.includes(value) || email.includes(value) || role.includes(value))
            ? "" : "none";
    });
});
</script>

</body>
</html>
