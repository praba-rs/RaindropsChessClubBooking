<?php
$servername = "localhost:3302";
$username = "prabha";  
$password = "yat9045";  
$dbname = "chess";

// $servername = "localhost:3306";
// $username = "tabehbss_chessuser";  
// $password = "goFattall63!";  
// $dbname = "tabehbss_chess";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
