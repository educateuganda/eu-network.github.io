<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educate_uganda";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the submitted form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];

// Perform any necessary validation on the form data

// Prepare and execute the SQL statement to insert the user registration data
$sql = "INSERT INTO students (fullname, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $fullname, $email, $password);

if ($stmt->execute()) {
    // Registration successful, redirect to a success page
    header('Location: registration_success.php');
    exit;
} else {
    // Registration failed, redirect back to the registration page with an error message
    header('Location: registrationpage.html?error=Registration failed. Please try again.');
    exit;
}


?>
