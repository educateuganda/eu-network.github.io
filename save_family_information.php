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
$generalComment = isset($_POST['general_comment']) ? $_POST['general_comment'] : '';

// Check if the family information already exists for the student code
$checkSql = "SELECT * FROM student_family WHERE student_code = '$studentCode'";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    // Family information already exists, ask the user if they want to replace it
    echo '<script>
            var replace = confirm("Family information already exists for this student. Do you want to replace it?");
            if (replace) {
                document.getElementById("replace").value = "true";
                document.getElementById("familyForm").submit();
            } else {
                document.getElementById("replace").value = "false";
                document.getElementById("familyForm").submit();
            }
          </script>';
} else {
    // Family information doesn't exist, proceed with the insertion
    // Retrieve sibling names and ages from the form
    $sibling1Name = $_POST['sibling1_name'];
    $sibling1Age = $_POST['sibling1_age'];
    $sibling2Name = $_POST['sibling2_name'];
    $sibling2Age = $_POST['sibling2_age'];
    $sibling3Name = $_POST['sibling3_name'];
    $sibling3Age = $_POST['sibling3_age'];

    // Prepare the SQL statement
    $insertSql = "INSERT INTO student_family (student_code, father_name, father_living, father_education_level, mother_name, mother_living, mother_education_level, guardian_name, guardian_education_level, birthdate, current_employment, num_siblings, sibling1_name, sibling1_age, sibling2_name, sibling2_age, sibling3_name, sibling3_age, general_comment)
                  VALUES ('$studentCode', '$fatherName', '$fatherLiving', '$fatherEducationLevel', '$motherName', '$motherLiving', '$motherEducationLevel', '$guardianName', '$guardianEducationLevel', '$birthdate', '$currentEmployment', '$numSiblings', '$sibling1Name', '$sibling1Age', '$sibling2Name', '$sibling2Age', '$sibling3Name', '$sibling3Age', '$generalComment')";

    if ($conn->query($insertSql) === TRUE) {
        echo "Family information saved successfully";
        echo "<a href='student_dashboardpage.php' style='cursor: pointer;'>👈 view Student Dashboard</a>";
    } else {
        echo "Error: " . $insertSql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
