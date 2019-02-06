<!-- This creates the connection string used by the website to connect to the database -->
<?php
$servername = "engrcapstone.clwb1p9ef3a0.us-east-2.rds.amazonaws.com";
$username = "CapAdmin";
$password = "CapstoneAdmin";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->select_db("engrcapstone");
?>
