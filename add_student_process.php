<?php
echo "Processing script is running!";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the submitted student details
    $fullname = $_POST['fullname'] ?? '';
    $general_comment = $_POST['general_comment'] ?? '';
    $home_address = $_POST['home_address'] ?? '';
    $current_address = $_POST['current_address'] ?? '';
    $telephone = $_POST['telephone'] ?? '';
    $email_address = $_POST['email_address'] ?? '';
    $awards = $_POST['awards'] ?? '';
    $profile_picture = $_FILES['profile_picture']['name'] ?? '';
    $primary_school = $_POST['primary_school'] ?? '';
    $secondary_school = $_POST['secondary_school'] ?? '';
    $post_secondary = $_POST['post_secondary'] ?? ''; // Corrected field name

    // Debugging - Display the submitted values
    var_dump($_POST);

    // Validate input fields
    if (empty($fullname) || empty($general_comment) || empty($home_address) || empty($profile_picture) || empty($current_address) || empty($telephone) || empty($email_address) || empty($awards) || empty($primary_school) || empty($secondary_school) || empty($post_secondary)) {
        // Handle the case where any field is empty
        echo "Please fill in all the required fields.";
        exit;
    }

    // Sanitize the input data
    $fullname = filter_var($fullname, FILTER_SANITIZE_STRING);
    $general_comment = filter_var($general_comment, FILTER_SANITIZE_STRING);
    $home_address = filter_var($home_address, FILTER_SANITIZE_STRING);
    $current_address = filter_var($current_address, FILTER_SANITIZE_STRING);
    $telephone = filter_var($telephone, FILTER_SANITIZE_STRING);
    $email_address = filter_var($email_address, FILTER_SANITIZE_STRING);
    $awards = filter_var($awards, FILTER_SANITIZE_STRING);
    $profile_picture = filter_var($profile_picture, FILTER_SANITIZE_STRING);
    $primary_school = filter_var($primary_school, FILTER_SANITIZE_STRING);
    $secondary_school = filter_var($secondary_school, FILTER_SANITIZE_STRING);
    $post_secondary = filter_var($post_secondary, FILTER_SANITIZE_STRING);

    // Additional data validation
    if (!preg_match("/^[a-zA-Z ]+$/", $fullname)) {
        echo "Invalid full name format.";
        exit;
    }

    // Validate the email address
    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email address format.";
        exit;
    }

    // File upload handling
    $targetDirectory = "uploads/"; // Specify the directory where uploaded files will be stored
    $fileExtension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
    $targetFilePath = $targetDirectory . uniqid() . '.' . $fileExtension;
    $uploadOk = true;
    $imageFileType = strtolower($fileExtension);

    // Check if a file is selected for upload
    if (!empty($profile_picture)) {
        // Check if the file is an image
        $check = getimagesize($_FILES['profile_picture']['tmp_name']);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = false;
        }

        // Check if the file already exists
        if (file_exists($targetFilePath)) {
            echo "File already exists.";
            $uploadOk = false;
        }

        // Check file size
        if ($_FILES['profile_picture']['size'] > 500000) {
            echo "File is too large. Maximum file size is 500KB.";
            $uploadOk = false;
        }

        // Allow only certain file formats
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowedExtensions)) {
            echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = false;
        }

        // If file upload is valid, move the file to the target directory
        if ($uploadOk) {
            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
                echo "File uploaded successfully.";
            } else {
                echo "Error uploading the file.";
                $uploadOk = false;
            }
        }
    }

    // If file upload was not successful, set the profile picture as empty
    if (!$uploadOk) {
        $profile_picture = '';
    } else {
        $profile_picture = basename($targetFilePath);
    }

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $dbname = "educate_uganda";
    $password = ""; // If your MySQL password is empty

    // Create a new database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement for inserting the student details
    $stmt = $conn->prepare("INSERT INTO student_profile (fullname, general_comment, home_address, current_address, telephone, email_address, awards, profile_picture, primary_school, secondary_school, post_secondary) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        echo "Error: " . $conn->error;
        exit;
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssssssssss", $fullname, $general_comment, $home_address, $current_address, $telephone, $email_address, $awards, $profile_picture, $primary_school, $secondary_school, $post_secondary);

    // Check if the execution was successful
    if ($stmt->execute() === TRUE) {
        echo "Student added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>
