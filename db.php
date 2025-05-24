<?php
// db.php
$host = "localhost";
$user = "root";         // change if using a different user
$pass = "";             // change if you have a password
$dbname = "smart_resume";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
