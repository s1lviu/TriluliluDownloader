<?php
$servername = "localhost";
$username = "mds";
$password = "mds2015";
$dbname = "trilulilu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>