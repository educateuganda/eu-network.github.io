<!DOCTYPE html>
<html>
<head>
  <title>Add Student's Grades - Educate Uganda Students Network</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  
  <style>
    /* CSS for form section */
    body {
      background-image: url('img/gradebg.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }
    
    .grades-form {
      margin-top: 20px;
      padding: 20px;
      border-radius: 5px;
      background-color: #ffffff;
      max-width: 400px;
      margin: 0 auto;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .grades-form h2 {
      margin-bottom: 10px;
      text-align: center;
    }
    
    .grades-form label {
      display: block;
      margin-bottom: 5px;
    }
    
    .grades-form input,
    .grades-form select {
      margin-bottom: 10px;
      padding: 8px;
      width: 100%;
      border-radius: 3px;
      border: 1px solid #ccc;
    }
    
    .grades-form button {
      padding: 10px 20px;
      background-color: maroon;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 100%;
    }
    
    .grades-form button:hover {
      background-color: #800080;
    }
  </style>
</head>
<body>
  <header>
    <h1>Add Student's Grades</h1>
  </header>
  <nav>
    <!-- Navigation links for student actions -->
  </nav>
  <main>
    <section class="grades-form">
      <form action="process_grades.php" method="POST">
        <h2>Student Grades Form</h2>
        
        <label for="student_code">Student Code:</label>
        <input type="text" id="student_code" name="student_code" required>

        <h3>Primary Grades</h3>
        
        <label for="marks_primary">Marks:</label>
        <input type="number" id="marks_primary" name="marks_primary">

        <label for="year_primary">Year:</label>
        <input type="text" id="year_primary" name="year_primary">

        <h3>Secondary Grades</h3>
        
        <label for="class_secondary">Class:</label>
        <select id="class_secondary" name="class_secondary">
          <option value="S.4">S.4</option>
          <option value="S.6">S.6</option>
        </select>

        <label for="marks_s4">S.4 Marks:</label>
        <input type="number" id="marks_s4" name="marks_s4">

        <label for="year_s4">S.4 Year:</label>
        <input type="text" id="year_s4" name="year_s4">

        <label for="marks_s6">S.6 Marks:</label>
        <input type="number" id="marks_s6" name="marks_s6">

        <label for="year_s6">S.6 Year:</label>
        <input type="text" id="year_s6" name="year_s6">

        <h3>Post-Secondary Grades</h3>
        
        <label for="course_postsecondary">Course:</label>
        <input type="text" id="course_postsecondary" name="course_postsecondary">

        <label for="cgpa_postsecondary">CGPA (out of 5):</label>
        <input type="number" id="cgpa_postsecondary" name="cgpa_postsecondary">

        <label for="year_postsecondary">Year:</label>
        <input type="text" id="year_postsecondary" name="year_postsecondary">

        <button type="submit">Submit Grades</button>
      </form>
    </section>
  </main>
  <footer>
    <!-- Footer content -->
  </footer>
</body>
</html>
