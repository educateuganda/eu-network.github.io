<!DOCTYPE html>
<html>
<head>
  <title>Student Grades</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("img/gradebg2.jpg"); /* Replace "img/background.jpg" with the path to your background image */
      background-repeat: no-repeat;
      background-size: cover;
      background-position: center;
      background-color: #f2f2f2;
    }

    h1 {
      text-align: center;
      font-size: 40px;
      color: maroon;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
    }

    .student-card {
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      padding: 20px;
    }

    .student-info {
      display: flex;
      align-items: center;
      margin-bottom: 20px;
    }

    .student-info .profile-picture {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      overflow: hidden;
      margin-right: 10px;
    }

    .student-info .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .grades-table {
      width: 100%;
      border-collapse: collapse;
    }

    .grades-table th,
    .grades-table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .grades-table th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    .no-grades {
      font-style: italic;
      color: red;
    }
  </style>
</head>
<body>
  <h1>Student Grades</h1>
  <?php
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

  // Check if a student code is provided in the URL
  if (isset($_GET['student_code'])) {
    $studentCode = $_GET['student_code'];

    // Retrieve the student's profile information
    $profileStmt = $pdo->prepare("SELECT fullname, profile_picture FROM student_profile WHERE student_code = :studentCode");
    $profileStmt->bindParam(':studentCode', $studentCode);
    $profileStmt->execute();
    $profile = $profileStmt->fetch(PDO::FETCH_ASSOC);

    // Check if the student exists
    if ($profile) {
      $fullname = $profile['fullname'];
      $profilePicture = $profile['profile_picture'];

      // Check if the profile picture exists
      if ($profilePicture) {
        // Display the profile picture
        echo "<div class='profile-picture'>";
        echo "<img src='uploads/$profilePicture' alt='Profile Picture'>";
        echo "</div>";
      } else {
        // Display a placeholder image or a default profile picture
        echo "<div class='profile-picture'>";
        echo "<img src='path_to_placeholder_image' alt='Profile Picture'>";
        echo "</div>";
      }

      // Display the student information and grades
      // ...

      // Retrieve the grades for the specified student
      $gradesStmt = $pdo->prepare("SELECT * FROM grades WHERE student_code = :studentCode");
      $gradesStmt->bindParam(':studentCode', $studentCode);
      $gradesStmt->execute();
      $grades = $gradesStmt->fetchAll(PDO::FETCH_ASSOC);

      // Check if the student has any grades
      if ($grades) {
        // Display the student information and grades
        echo "<div class='student-card'>";
        echo "<div class='student-info'>";
        echo "<div class='profile-picture'>";
        if ($profilePicture) {
          // Display the profile picture
          echo "<img src='uploads/$profilePicture' alt='Profile Picture'>";
        } else {
          // Display a placeholder image or a default profile picture
          echo "<img src='path_to_placeholder_image' alt='Profile Picture'>";
        }
        echo "</div>";
        echo "<div>";
        echo "<div class='student-code'>$studentCode</div>";
        echo "<div>$fullname</div>";
        echo "</div>";
        echo "</div>";
        echo "<table class='grades-table'>";
        echo "<tr>";
        echo "<th>Level</th>";
        echo "<th>Marks (Primary)</th>";
        echo "<th>Year (Primary)</th>";
        echo "<th>Marks (S4)</th>";
        echo "<th>Year (S4)</th>";
        echo "<th>Marks (S6)</th>";
        echo "<th>Year (S6)</th>";
        echo "<th>Course</th>";
        echo "<th>CGPA</th>";
        echo "<th>Year (Post-Secondary)</th>";
        echo "</tr>";

        foreach ($grades as $grade) {
          echo "<tr>";
          echo "<td>{$grade['level']}</td>";
          echo "<td>{$grade['marks_primary']}</td>";
          echo "<td>{$grade['year_primary']}</td>";
          echo "<td>{$grade['marks_s4']}</td>";
          echo "<td>{$grade['year_s4']}</td>";
          echo "<td>{$grade['marks_s6']}</td>";
          echo "<td>{$grade['year_s6']}</td>";
          echo "<td>{$grade['course_postsecondary']}</td>";
          echo "<td>{$grade['cgpa_postsecondary']}</td>";
          echo "<td>{$grade['year_postsecondary']}</td>";
          echo "</tr>";
        }

        echo "</table>";
        echo "</div>";
      } else {
        echo "<p class='no-grades'>No grades available for this student.</p>";
      }
    } else {
      echo "<p class='no-grades'>Student not found.</p>";
    }
  } else {
    echo "<p class='no-grades'>No student code provided.</p>";
  }
  ?>
</body>
</html>
