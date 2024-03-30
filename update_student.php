<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student - Educate Uganda Students Network</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Add your CSS styles for this page if needed -->
</head>
<body>
    <header>
        <h1>Edit Student Information</h1>
    </header>
    <main>
        <?php
        // Check if the user is an administrator (you should have proper authentication logic here)
        $is_admin = true; // Set this based on the user's admin status

        if ($is_admin) {
            // Check if the student_code is provided in the query string
            if (isset($_GET['student_code'])) {
                $student_code = $_GET['student_code'];

                // Retrieve student information based on the student_code from your database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "educate_uganda";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM student_profile WHERE student_code = '$student_code'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $fullname = $row['fullname'];
                    $homeAddress = $row['home_address'];
                    $currentAddress = $row['current_address'];
                    $telephone = $row['telephone'];
                    $email_address = $row['email_address'];
                    $awards = $row['awards'];
                    $primary_school = $row['primary_school'];
                    $secondary_school = $row['secondary_school'];
                    $post_secondary = $row['post_secondary'];
                    $profile_picture = $row['profile_picture'];
                
                    // Display a form for editing student information
                    echo "<form action='update_student.php' method='POST' enctype='multipart/form-data'>";
                    echo "<label for='student_code'>Student Code:</label>";
                    echo "<input type='text' name='student_code' value='$student_code' readonly>"; // readonly to prevent editing

                    echo "<label for='fullname'>Full Name:</label>";
                    echo "<input type='text' name='fullname' value='$fullname'>";
                    echo "<label for='home_address'>Home Address:</label>";
                    echo "<input type='text' name='home_address' value='$homeAddress'>";
                    echo "<label for='current_address'>Current Address:</label>";
                    echo "<input type='text' name='current_address' value='$currentAddress'>";
                    echo "<label for='telephone'>Telephone:</label>";
                    echo "<input type='text' name='telephone' value='$telephone'>";
                    echo "<label for='email_address'>Email Address:</label>";
                    echo "<input type='text' name='email_address' value='$email_address'>";
                    echo "<label for='awards'>Awards:</label>";
                    echo "<input type='text' name='awards' value='$awards'>";
                    echo "<label for='primary_school'>Primary School:</label>";
                    echo "<input type='text' name='primary_school' value='$primary_school'>";
                    echo "<label for='secondary_school'>Secondary School:</label>";
                    echo "<input type='text' name='secondary_school' value='$secondary_school'>";
                    echo "<label for='post_secondary'>Post-Secondary:</label>";
                    echo "<input type='text' name='post_secondary' value='$post_secondary'>";
                    echo "<label for='profile_picture'>Profile Picture:</label>";
                    echo "<input type='file' name='profile_picture'>";
                    echo "<input type='submit' value='Save Changes'>";
                    echo "</form>";
                } else {
                    echo "<p>Student not found.</p>";
                }

                $conn->close();
            } else {
                echo "<p>Student code not provided.</p>";
            }
        } else {
            echo "<p>Access denied. You are not an administrator.</p>";
        }
        ?>
    </main>
</body>
</html>
