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

$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);


// Fetch data from the database
$sql = "select childname, parentname, contactnumberofparent, emailid, IF(paymentreceived, 'Yes', 'No') paymentreceived , IF(cancelled, 'Yes', 'No') cancelled ,IF(waitlist, 'Yes', 'No') waitlist from raindropsbooking order by childname";
    
$result = $conn->query($sql.$where);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- <link rel="stylesheet" href="dandiya.css">  -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chess report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        th{
          color: black;
          background: #CCCCFF;
        }
    </style>
</head>
<body>

<div>
    <h2 class="my-4">Registration details</h2>
    <?php
    if ($result->num_rows > 0) {

        echo '<table class="table table-sm">';
        echo '<thead class="thead-dark">';
        echo '<tr><th>Name</th><th>Parent Name</th><th>Phone</th><th>email</th><th>Payment</th><th>Cancel</th><th>Waitlist</th></tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["childname"] . '</td>';
            echo '<td>' . $row["parentname"] . '</td>';
            echo '<td>' . $row["contactnumberofparent"] . '</td>';
            echo '<td>' . $row["emailid"] . '</td>';
            echo '<td>' . $row["paymentreceived"] . '</td>'; 
            echo '<td>' . $row["cancelled"] . '</td>';
            echo '<td>' . $row["waitlist"] . '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "0 results";
    }
    
    // Close the database connection
    $conn->close();
    ?>
</div>

</body>
</html>
