<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
// Include the database connection
include '../db.php';


$sql = "SELECT * FROM raindrops_child_registration ORDER BY created_at DESC";
$result = $conn->query($sql);

$total = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Child Registration Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Child Registration Report</h3>
                <span class="badge bg-primary">
                    Total Registrations: <?php echo $total; ?>
                </span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Child Name</th>
                            <th>DOB</th>
                            <th>Age</th>
                            <th>Parent Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Registered On</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    if ($total > 0) {
                        while($row = $result->fetch_assoc()) {

                            // Calculate Age
                            $dob = new DateTime($row['dob']);
                            $today = new DateTime();
                            $age = $today->diff($dob)->y;

                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['child_name']}</td>
                                    <td>{$row['dob']}</td>
                                    <td>{$age} Years</td>
                                    <td>{$row['parent_name']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['address']}</td>
                                    <td>{$row['created_at']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center text-danger'>No records found</td></tr>";
                    }
                    ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>
