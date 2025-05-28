<?php
$host = "localhost";        // XAMPP uses localhost
$user = "root";             // default user for XAMPP
$password = "";             // default is blank
$database = "email_verification";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("❌ Database connection failed: " . mysqli_connect_error());
}
?>
