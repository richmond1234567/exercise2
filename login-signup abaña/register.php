<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $first = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Password match check
    if ($pass !== $confirm) {
        die("❌ Passwords do not match.");
    }

    // Hash password and generate token
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
    $token = md5(uniqid(rand(), true));

    // Insert user into DB
    $query = "INSERT INTO users (first_name, last_name, email, password, token, is_verified)
              VALUES ('$first', '$last', '$email', '$hashed_pass', '$token', 0)";

    if (mysqli_query($conn, $query)) {
        // Build verification link
        $verification_link = "http://localhost/LOGIN-SIGNUP ABAÑA/verify.php?token=$token";

        // FOR TESTING: Output the link instead of sending email
        echo "✅ User registered successfully!<br>";
        echo "🧪 Copy and paste this verification link in your browser to verify the account:<br>";
        echo "<a href='$verification_link'>$verification_link</a>";
    } else {
        echo "❌ Error inserting user: " . mysqli_error($conn);
    }
} else {
    echo "❌ Invalid request method.";
}
?>
