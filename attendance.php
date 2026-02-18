<?php
// Database connection

include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$message = "";

// Fetch children list
$children = $conn->query("SELECT id, child_name FROM raindrops_child_registration ORDER BY child_name ASC");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['child_id'])) {

        $child_id = $_POST['child_id'];
        $today = date("Y-m-d");

        $stmt = $conn->prepare("INSERT INTO raindrops_child_attendance (child_id, attend_date) VALUES (?, ?)");
        $stmt->bind_param("is", $child_id, $today);

        // if ($stmt->execute()) {
        //     $message = "<div class='alert alert-success'>Attendance Saved Successfully!</div>";
        // } else {
        //     if ($conn->errno == 1062) {
        //         $message = "<div class='alert alert-warning'>Attendance already marked for today!</div>";
        //     } else {
        //         $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        //     }
        // }


        try {
            $stmt->execute();
            $message = "<div class='alert alert-success'>Attendance Saved Successfully!</div>";
        }
        catch(Exception $e){
                 $message = "<div class='alert alert-danger'>Error: Attendance marked already..." . "</div>";
                       }

        $stmt->close();
    } else {
        $message = "<div class='alert alert-danger'>Please select a child.</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Child Attendance</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-5">

            <div class="card shadow">
                <div class="card-body">

                    <h4 class="text-center mb-4">Mark Child Attendance</h4>

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Select Child</label>
                            <select name="child_id" class="form-select" required>
                                <option value="">-- Select Child --</option>
                                <?php while($row = $children->fetch_assoc()) { ?>
                                    <option value="<?php echo $row['id']; ?>">
                                        <?php echo $row['child_name']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <br><br><br>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Present
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
