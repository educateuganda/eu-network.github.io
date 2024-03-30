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

// Check if a search query is provided
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    
    // Prepare and execute the SQL statement to retrieve student details based on the search value
    $sql = "SELECT * FROM student_profile WHERE fullname LIKE '%$search%'";
    $result = $conn->query($sql);

    // Check if any student records are found
    if ($result->num_rows > 0) {
        // Loop through each student record and construct the HTML content
        $html = "<h2>All Students</h2>";
        while ($row = $result->fetch_assoc()) {
            $fullname = $row['fullname'];
            $general_comment = $row['general_comment'];
            $homeAddress = $row['home_address'];
            $currentAddress = $row['current_address'];
            $telephone = $row['telephone'];
            $email_address = $row['email_address'];
            $awards = $row['awards'];
            $profile_picture = $row['profile_picture'];
            $primary_school = $row['primary_school'];
            $secondary_school = $row['secondary_school'];
            $post_secondary = $row['post_secondary'];

            // Construct the HTML content for each student profile
            $html .= "<img src='uploads/" . $profile_picture . "' alt='profile_picture' class='profile-picture'>";
            $html .= "<h3>$fullname</h3>";
            $html .= "<p><strong>Home-Address:</strong> $homeAddress</p>";
            $html .= "<p><strong>Current-Address:</strong> $currentAddress</p>";
            $html .= "<p><strong>Telephone:</strong> $telephone</p>";
            $html .= "<p><strong>Email-Address:</strong> $email_address</p>";
            $html .= "<p><strong>Awards:</strong> $awards</p>";
            $html .= "<p><strong>Primary School:</strong> $primary_school</p>";
            $html .= "<p><strong>Secondary School:</strong> $secondary_school</p>";
            $html .= "<p><strong>Post-Secondary:</strong> $post_secondary</p>";
            $html .= "<p><strong>General Comment:</strong> $general_comment</p>";

            // Check if the user is an admin
            $is_admin = false; // Set this variable based on the admin status of the user
            if ($is_admin) {
                $html .= "<button class='edit-button' onclick='editStudent()'>Edit</button>";
            }
        }
        echo $html; // Return the constructed HTML content
    } else {
        echo "No student records found.";
    }
}

// Close the database connection
$conn->close();
?>
