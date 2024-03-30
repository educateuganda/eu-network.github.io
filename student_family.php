<!DOCTYPE html>
<html>
<head>
  <title>Student Family Information</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    /* ... (existing styles) ... */

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
    }

    .student-card {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      grid-gap: 20px;
      margin-bottom: 40px;
      padding: 20px;
      background-color: #872642;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    .student-info {
      display: flex;
      align-items: center;
    }

    .profile-picture img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
    }
    h1 {
      background-image: url('headerbg.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
      padding: 0px;
      position: relative;
      text-align: center;
      
    }

    .family-information {
      grid-column: span 2;
      border-top: 1px solid #ccc;
      padding-top: 20px;
      margin-top: 20px;
    }

    .family-information h3,
    .family-information h4 {
      margin-top: 10px;
    }

    .family-information p {
      margin-bottom: 5px;
    }

    .comment-section {
      grid-column: span 2;
      padding: 20px;
      background-color: #A0D3F9;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 50px;
      display: flex;
      flex-direction: column;
      align-items: flex-start;
    }
    .comment-section h4 {
      margin-top: 0;
    }

    .comment-section p {
      margin-bottom: 10px;
    }
    body {
      background-image: url('img/fambg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
    }

  </style>
</head>
<body>
  <div class="container">
    <h1>Student Family Information</h1>

<?php
// Check if the student_code parameter is provided in the URL
if (isset($_GET['student_code'])) {
    $student_code = $_GET['student_code'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "educate_uganda";

    // Create a new PDO instance
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }

    // Retrieve the student's profile information
    $profileStmt = $pdo->prepare("SELECT fullname, profile_picture FROM student_profile WHERE student_code = :studentCode");
    $profileStmt->bindParam(':studentCode', $student_code);
    $profileStmt->execute();
    $profile = $profileStmt->fetch(PDO::FETCH_ASSOC);

    // Check if the student exists
    if ($profile) {
        $fullname = $profile['fullname'];
        $profilePicture = $profile['profile_picture'];

        // Display student grid card
        echo "<div class='student-card'>";
        echo "<div class='student-info'>";
        echo "<div class='profile-picture'>";
        // Check if the profile picture exists
        if ($profilePicture) {
            // Display the profile picture
            echo "<img src='uploads/$profilePicture' alt='Profile Picture'>";
        } else {
            // Display a placeholder image or a default profile picture
            echo "<img src='path_to_placeholder_image' alt='Profile Picture'>";
        }
        echo "</div>";

        echo "<h2><span style='font-family: Arial, sans-serif;'>$student_code</span></h2>";
        echo "<h3><span style='font-family: Arial, sans-serif;'>$fullname</span></h3>";

        // Display additional student information if needed
        echo "</div>";

        // Prepare and execute the SQL statement to retrieve the family information
        $sql = "SELECT * FROM student_family WHERE student_code = '$student_code'";
        $result = $pdo->query($sql);

        // Check if any family records are found
        if ($result !== false && $result->rowCount() > 0) {
            // Loop through each family record
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                $father_name = $row['father_name'];
                $father_living = $row['father_living'];
                $father_education_level = $row['father_education_level'];
                $mother_name = $row['mother_name'];
                $mother_living = $row['mother_living'];
                $mother_education_level = $row['mother_education_level'];
                $guardian_name = $row['guardian_name'];
                $guardian_education_level = $row['guardian_education_level'];
                $birthdate = $row['birthdate'];
                $current_employment = $row['current_employment'];
                $num_siblings = $row['num_siblings'];
                $general_comment = $row['general_comment'];

                // Retrieve the siblings' names and ages
                $siblings = [];
                for ($i = 1; $i <= $num_siblings; $i++) {
                    $sibling_name = $row["sibling{$i}_name"];
                    $sibling_age = $row["sibling{$i}_age"];
                    $siblings[] = ['name' => $sibling_name, 'age' => $sibling_age];
                }

                // Display family information
                echo "<div class='family-information'>";
                echo "<h3>Father's Name: $father_name</h3>";
                echo "<p><strong>Is Father Living?:</strong> $father_living</p>";
                echo "<p><strong>Father's Education Level:</strong> $father_education_level</p>";
                echo "<h3>Mother's Name: $mother_name</h3>";
                echo "<p><strong>Is Mother Living?:</strong> $mother_living</p>";
                echo "<p><strong>Mother's Education Level:</strong> $mother_education_level</p>";
                 echo "<h3>Number of Siblings: $num_siblings</h3>";
                
                  echo "<h3>Siblings:</h3>";
                 // Display the siblings' names and ages
                foreach ($siblings as $sibling) {
                    $siblingName = $sibling['name'];
                    $siblingAge = $sibling['age'];
                    echo "<p><strong>Name:</strong> $siblingName, <strong>Age:</strong> $siblingAge</p>";
                }
                echo "<h3>Guardian's Name: $guardian_name</h3>";
                echo "<p><strong>Guardian's Education Level:</strong> $guardian_education_level</p>";
                echo "<h3>Birthdate: $birthdate</h3>";
                echo "<p><strong>Current Employment:</strong> $current_employment</p>";
       
                echo "</div>";
             //Display the comment section
                echo "<div class='comment-section'>";
                echo "<h4> Student's General Comment:</h4>";
                echo "<p>$general_comment</p>";
                echo "</div>"; // Close comment-section div
            }
           // Add the back link with the pointing hand symbol
        echo "<a href='{$_SERVER['HTTP_REFERER']}' style='cursor: pointer;'>👈 Go Back</a>";

        } else {
            // No family records found
            echo "<p>No family information available for this student.</p>";
        }

        echo "</div>"; // Close student-card div

    } else {
        // Student not found
        echo "<p>Student not found.</p>";
    }

    // Close the database connection
    $pdo = null;
} else {
    // student_code parameter not provided
    echo "<p>No student code provided.</p>";
}
?>

</div>
</body>
</html>
