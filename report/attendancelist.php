<?php
// Database connection
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


$message = "";
$selected_date = "";

// Get distinct attendance dates
$date_query = $conn->query("SELECT DISTINCT attend_date  FROM raindrops_child_attendance ORDER BY attend_date DESC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['attend_date'])) {
        $selected_date = $_POST['attend_date'];
    } else {
        $message = "<div class='alert alert-danger'>Please select a date.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">

    <div class="card shadow mb-4">
        <div class="card-body">
            <h4 class="mb-3">Attendance Report</h4>

            <?php echo $message; ?>

            <form method="POST" class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Select Date</label>
                    <select name="attend_date" class="form-select" required>
                        <option value="">-- Select Date --</option>
                        <?php while($row = $date_query->fetch_assoc()) { ?>
                            <option value="<?php echo $row['attend_date']; ?>"
                                <?php if($selected_date == $row['attend_date']) echo "selected"; ?>>
                                <?php echo $row['attend_date']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <label class="form-label invisible">Button</label>
                    <button type="submit" class="btn btn-primary">View</button>
                </div>
            </form>
        </div>
    </div>

<?php
if (!empty($selected_date)) {

    $stmt = $conn->prepare("
        SELECT cr.child_name, cr.parent_name, cr.phone
        FROM raindrops_child_attendance ca
        JOIN raindrops_child_registration cr ON ca.child_id = cr.id
        WHERE ca.attend_date = ?
        ORDER BY cr.child_name ASC
    ");
    $stmt->bind_param("s", $selected_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $total = $result->num_rows;
?>

    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h5>Attendance for: <?php echo $selected_date; ?></h5>
                <span class="badge bg-success">Total Present: <?php echo $total; ?></span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Child Name</th>
                            <th>Parent Name</th>
                            <th>Phone</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if ($total > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$i}</td>
                                        <td>{$row['child_name']}</td>
                                        <td>{$row['parent_name']}</td>
                                        <td>{$row['phone']}</td>
                                      </tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center text-danger'>No attendance records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
    $stmt->close();
}

$conn->close();
?>

</div>

</body>
</html>
