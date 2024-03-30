<?php
// Assuming you have a database connection established
// Connect to your database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "educate_uganda";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data from the previous page
$studentCode = $_POST['student_code'];
$fatherName = $_POST['father_name'];
$fatherLiving = $_POST['father_living'];
$fatherEducationLevel = $_POST['father_education_level'];
$motherName = $_POST['mother_name'];
$motherLiving = $_POST['mother_living'];
$motherEducationLevel = $_POST['mother_education_level'];
$guardianName = $_POST['guardian_name'];
$guardianEducationLevel = $_POST['guardian_education_level'];
$birthdate = $_POST['birthdate'];
$currentEmployment = $_POST['current_employment'];
$numSiblings = $_POST['num_siblings'];

// Check if the user chose to replace the existing information
if (isset($_POST['replace']) && $_POST['replace'] === 'true') {
    // Prepare and execute the SQL query to update data in the student_family table
    $updateSql = "UPDATE student_family 
                  SET father_name = '$fatherName', father_living = '$fatherLiving', father_education_level = '$fatherEducationLevel',
                      mother_name = '$motherName', mother_living = '$motherLiving', mother_education_level = '$motherEducationLevel',
                      guardian_name = '$guardianName', guardian_education_level = '$guardianEducationLevel', birthdate = '$birthdate',
                      current_employment = '$currentEmployment', num_siblings = '$numSiblings'
                  WHERE student_code = '$studentCode'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Family information updated successfully";
    } else {
        echo "Error: " . $updateSql . "<br>" . $conn->error;
    }
} else {
    // User chose to skip, display a message or redirect to another page if needed
    echo "Family information was not replaced.";
}

// Close the database connection
$conn->close();
?>
