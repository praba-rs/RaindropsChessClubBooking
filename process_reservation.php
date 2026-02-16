<?php
// Include the database connection
include 'db.php';


include 'tools.php';
$ini = parse_ini_file('app.ini');
$fare = $ini['fare'];

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$childname = $_POST['childname'];
$gender = $_POST['gender'];
$dateofbirth = $_POST['dateofbirth'];
$parentname = $_POST['parentname'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$waitlist = $_POST['waitlist'];

// Insert data into the database
date_default_timezone_set('Asia/Tokyo');
$currtime = date("Y-m-d H:i:s")        ;

$querystatus = TRUE;

$sql = "INSERT INTO raindropsbooking (childname,gender,dateofbirth,parentname, emailid, contactnumberofparent, waitlist,reservationtime) VALUES ('$childname', '$gender', '$dateofbirth', 
'$parentname', '$email', '$phone','$waitlist','$currtime')";
try{
    $querystatus=$conn->query($sql);
}
catch(Exception $e) {
    echo "<br><br><h2>Duplicate entry not allowed<br>Name:$childname</h2>";
  }

if ($querystatus === TRUE) {
    $waitmsg0 = ($waitlist==="1")?" WAITLISTED":"CONFIRMED";
    echo "<div style='margin-left:200px; width:100%;'><br><br><br><h2>Chess </h2><h2>Your details are registered... $waitmsg0</h2> </br></br>
    <br><h3>Data entered are as below</h3><br>Child name: $childname<br>
        Date of Birth:$dateofbirth<br>
        Parent name:$parentname<br>
        Email:$email<br>
        Phone:$phone<br>

        <BR><BR>
        <hr>
        <p>Please join the watsapp group. please join it using the following link</p>
        <a></a>
        <a href=' https://chat.whatsapp.com/ISWfnEfD6He0giqu1Sc7jm'>https://chat.whatsapp.com/ISWfnEfD6He0giqu1Sc7jm</a>
        <div>";
} 


if ($querystatus === FALSE)
{
    echo "Error: " . $conn->error;
}

$conn->close();


  
?>
