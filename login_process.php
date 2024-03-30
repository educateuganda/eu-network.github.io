<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Retrieve the submitted email and password
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    header('Location: login.php?error=Please enter your email and password.');
    exit;
}

$servername = "localhost";
$username = "root";
$dbpassword = ""; // Changed variable name to avoid conflict with password variable
$dbname = "educate_uganda";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT id, password, is_admin, has_family_info FROM students WHERE email = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();

if ($result === false) {
    die("Execute failed: " . $stmt->error);
}

// Check if a user with the given email exists
if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedHashedPassword = $row['password'];
    $is_admin = $row['is_admin'];
    $has_family_info = $row['has_family_info'];

    if (password_verify($password, $storedHashedPassword)) {
        session_start();
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = $is_admin;

        if ($is_admin) {
            header('Location: admin_dashboard_page.html');
            exit;
        } else {
            if ($has_family_info) {
                header('Location: student_dashboardpage.php');
                exit;
            } else {
                header('Location: student_dashboardpage.php');
                exit;
            }
        }
    }
}

// Redirect back to the login page with an error message
header('Location: login.php?error=Invalid email or password.');
exit;
