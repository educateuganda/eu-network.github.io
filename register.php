<?php
// Retrieve the submitted form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Validate user input
if (empty($fullname) || empty($email) || empty($password)) {
    // Redirect back to the registration page with an error message
    header('Location: registrationpage.html?error=Please fill in all the fields.');
    exit;
}

// Hash the password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Database connection
$servername = "localhost";
$username = "root";
$dbpassword = ""; // Changed variable name to avoid conflict with password variable
$dbname = "educate_uganda";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query to insert the user data
$stmt = $conn->prepare("INSERT INTO students (fullname, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $fullname, $email, $hashedPassword);
$stmt->execute();

// Redirect to the registration success page
header('Location: registration_success.php');
exit;
?>
