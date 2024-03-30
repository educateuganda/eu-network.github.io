<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard - Educate Uganda Students Network</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
     /* CSS for sidebar */
    .sidebar {
      background-color: #333;
      color: #fff;
      padding: 20px;
      height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      width: 200px;
    }

    .sidebar a {
      display: block;
      color: #fff;
      text-decoration: none;
      padding: 10px;
      margin-bottom: 10px;
      border-bottom: 1px solid #555;
    }
    /* CSS for search form */
    .search-form {
      margin-top: 20px;
      display: flex;
      align-items: center;
      justify-content: flex-end;
    }

    .search-form input[type="text"] {
      margin-right: 5px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .search-form input[type="text"]:hover {
      background-color: purple;
      color: white;
    }
    
    /* CSS for profile picture */
    .profile-picture {
      width: 150px; /* Set the desired width */
      height: 150px; /* Set the desired height */
      object-fit: cover;
      border-radius: 50%;
      margin-bottom: 20px;
    }
    
    /* CSS for student details */
    .student-details {
      background-color: #f2f2f2;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
      position: relative; /* Add position: relative */
    }
    
    .student-details h3 {
      margin: 0;
    }
    
    .student-details p {
      margin: 5px 0;
      
    }
    
    .student-details strong {
      font-weight: bold;
      font-size: large
    }
    
    .edit-button {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    
    .edit-button:hover {
      background-color: #555;
    }
    
    .no-records {
      text-align: center;
      margin-top: 20px;
    }
    
    /* CSS for grid layout */
    .student-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr); /* Set the number of columns here */
      grid-gap: 20px; /* Adjust the gap between student profiles */
    }
    
    /* CSS for grades link */
    .grades-link {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #555;
      text-decoration: none;
      font-size: 50px;
    }

      .family-link {
      position: relative;
      top: 10px;
      right: 10px;
      color: #555;
      text-decoration: none;
      font-size: 50px;
    }
    /* Add your additional styles here */
  </style>
</head>
<body style="background-color: maroon;">
<!-- Sidebar -->
  <!--div class="sidebar">
    <a href="#">Home</a>
    <a href="display_grades.php">Student Grades</a>
    <a href="student_family.php">Student Family</a>
    <a href="#">Logout</a>
  </div> -->
  <header>
    <h1>Student Dashboard</h1>
  </header>
  <nav>
    <!-- Navigation links for student actions -->
  </nav>
  <main>
    <!-- Search form -->
    <form class="search-form" method="GET" action="">
      <input type="text" name="search" placeholder="Search by name">
      <button type="submit">Search</button>
    </form>
    <section class="student-grid">
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

      // Prepare and execute the SQL statement to retrieve all student details
      $sql = "SELECT * FROM student_profile";
      
      // Check if a search query is provided
      if (isset($_GET['search']) && !empty($_GET['search'])) {
          $search = $_GET['search'];
          $sql = "SELECT * FROM student_profile WHERE fullname LIKE '%$search%'";
      }
      
      $result = $conn->query($sql);

      // Check if any student records are found
      if ($result->num_rows > 0) {
          // Loop through each student record
          while ($row = $result->fetch_assoc()) {
              $fullname = $row['fullname'];
              $homeAddress = $row['home_address'];
              $currentAddress = $row['current_address'];
              $telephone = $row['telephone'];
              $email_address = $row['email_address'];
              $awards = $row['awards'];
              $profile_picture = $row['profile_picture'];
              $primary_school = $row['primary_school'];
              $secondary_school = $row['secondary_school'];
              $post_secondary = $row['post_secondary'];
              $student_code = $row['student_code'];

              // Display student details and profile picture with a default if no image is uploaded
              echo "<div class='student-details'>";
              echo "<img src='" . (empty($profile_picture) ? 'uploads/profilepictureicon.png' : "uploads/$profile_picture") . "' alt='Profile Picture' class='profile-picture'>";
              echo "<h3>$fullname</h3>";
              echo "<p><strong>Home Address:</strong> $homeAddress</p>";
              echo "<p><strong>Current Address:</strong> $currentAddress</p>";
              echo "<p><strong>Telephone:</strong> $telephone</p>";
              echo "<p><strong>Email Address:</strong> $email_address</p>";
              echo "<p><strong>Awards:</strong> $awards</p>";
              echo "<p><strong>Primary School:</strong> $primary_school</p>";
              echo "<p><strong>Secondary School:</strong> $secondary_school</p>";
              echo "<p><strong>Post-Secondary:</strong> $post_secondary</p>";

              // Link to the grades page
              echo "<a href='display_grades.php?student_code=$student_code' class='grades-link'>&#128214;</a>";

              // Link to the family page
              echo "<a href='student_family.php?student_code=$student_code' class='family-link'>&#128106;</a>";

              echo "</div>"; // Close the student-details div
          }
      } else {
          echo "<p class='no-records'>No student records found.</p>";
      }

      // Close the database connection
      $conn->close();
      ?>
    </section>
  </main>
  <footer>
    <!-- Footer content -->
  </footer>
</body>
</html>
