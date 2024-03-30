<?php
// Database connection
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

// Process form data and insert into database
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $studentCode = $_POST['student_code'];

    // Verify that the student_code exists in the student_profile table
    $verifyStmt = $pdo->prepare("SELECT COUNT(*) FROM student_profile WHERE student_code = :studentCode");
    $verifyStmt->bindParam(':studentCode', $studentCode);
    $verifyStmt->execute();
    $count = $verifyStmt->fetchColumn();

    if ($count > 0) {
        // Check if the student_code already exists in the grades table
        $existingStmt = $pdo->prepare("SELECT COUNT(*) FROM grades WHERE student_code = :studentCode");
        $existingStmt->bindParam(':studentCode', $studentCode);
        $existingStmt->execute();
        $existingCount = $existingStmt->fetchColumn();

        if ($existingCount > 0) {
            echo "Error: Grades for student_code '$studentCode' already exist.";
        } else {
            // Process primary grades
            $marksPrimary = $_POST['marks_primary'];
            $yearPrimary = $_POST['year_primary'];

            // Prepare and execute the SQL query for primary grades
            $stmt = $pdo->prepare("INSERT INTO grades (level, marks_primary, year_primary, student_code)
                                   VALUES ('Primary', :marksPrimary, :yearPrimary, :studentCode)");
            $stmt->bindParam(':marksPrimary', $marksPrimary);
            $stmt->bindParam(':yearPrimary', $yearPrimary);
            $stmt->bindParam(':studentCode', $studentCode);

            if ($stmt->execute()) {
                echo "Primary grades added successfully. ";
            } else {
                echo "Error: Unable to add primary grades. ";
            }

            // Process secondary grades
            $marksS4 = $_POST['marks_s4'];
            $yearS4 = $_POST['year_s4'];
            $marksS6 = $_POST['marks_s6'];
            $yearS6 = $_POST['year_s6'];

            // Prepare and execute the SQL query for secondary grades
            $stmt = $pdo->prepare("INSERT INTO grades (level, marks_s4, year_s4, marks_s6, year_s6, student_code)
                                   VALUES ('Secondary', :marksS4, :yearS4, :marksS6, :yearS6, :studentCode)");
            $stmt->bindParam(':marksS4', $marksS4);
            $stmt->bindParam(':yearS4', $yearS4);
            $stmt->bindParam(':marksS6', $marksS6);
            $stmt->bindParam(':yearS6', $yearS6);
            $stmt->bindParam(':studentCode', $studentCode);

            if ($stmt->execute()) {
                echo "Secondary grades added successfully. ";
            } else {
                echo "Error: Unable to add secondary grades. ";
            }

            // Process post-secondary grades
            $coursePostSecondary = $_POST['course_postsecondary'];
            $cgpaPostSecondary = $_POST['cgpa_postsecondary'];
            $yearPostSecondary = $_POST['year_postsecondary'];

            // Prepare and execute the SQL query for post-secondary grades
            $stmt = $pdo->prepare("INSERT INTO grades (level, course_postsecondary, cgpa_postsecondary, year_postsecondary, student_code)
                                   VALUES ('Post-Secondary', :coursePostSecondary, :cgpaPostSecondary, :yearPostSecondary, :studentCode)");
            $stmt->bindParam(':coursePostSecondary', $coursePostSecondary);
            $stmt->bindParam(':cgpaPostSecondary', $cgpaPostSecondary);
            $stmt->bindParam(':yearPostSecondary', $yearPostSecondary);
            $stmt->bindParam(':studentCode', $studentCode);

            if ($stmt->execute()) {
                echo "Post-Secondary grades added successfully.";
            } else {
                echo "Error: Unable to add post-secondary grades.";
            }
        }
    } else {
        echo "Error: Invalid student_code.";
    }
}
?>
