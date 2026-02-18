<?php


include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $child_name  = trim($_POST['child_name']);
    $dob         = $_POST['dob'];
    $parent_name = trim($_POST['parent_name']);
    $phone       = trim($_POST['phone']);
    $address     = trim($_POST['address']);

    if (!empty($child_name) && !empty($dob) && !empty($parent_name) && !empty($phone) && !empty($address)) {

        $stmt = $conn->prepare("INSERT INTO raindrops_child_registration (child_name, dob, parent_name, phone, address) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $child_name, $dob, $parent_name, $phone, $address);

        if ($stmt->execute()) {
            $message = "<div class='alert alert-success'>Registration Successful!</div>";
        } else {
            $message = "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
    } else {
        $message = "<div class='alert alert-danger'>All fields are required!</div>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <title>Child Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow">
                <div class="card-body p-4">
                    
                    <h2 class="text-center mb-4">Raindrops Chess Club</h2>
                    <h3 class="text-center mb-4">Child Registration Form</h3>

                    <?php echo $message; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Child Name</label>
                            <input type="text" name="child_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Child Date of Birth</label>
                            <input type="date" name="dob" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mother / Father Name</label>
                            <input type="text" name="parent_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone Number (Mother/Father)</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address - station name is ok</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
