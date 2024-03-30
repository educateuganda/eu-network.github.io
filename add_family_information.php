<!DOCTYPE html>
<html>
<head>
  <title>Student Family Information</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("img/fambg.jpg"); /* Replace "img/background.jpg" with the path to your background image */
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

    .form-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .form-container label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .form-container input[type="text"],
    .form-container input[type="number"],
    .form-container select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    .form-container button {
      background-color: maroon;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .form-container button:hover {
      background-color: #800000;
    }
  </style>
</head>
<body>
  <h1>Student Family Information</h1>
  <div class="form-container">
    <form action="save_family_information.php" method="post">
      <label for="student_code">Student Code:</label>
      <input type="text" id="student_code" name="student_code" required>

      <label for="father_name">Father's Name:</label>
      <input type="text" id="father_name" name="father_name" required>

      <label for="father_living">Is Father Living?</label>
      <select id="father_living" name="father_living" required>
        <option value="">Select an option</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <label for="father_education_level">Father's Education Level:</label>
      <input type="text" id="father_education_level" name="father_education_level">

      <label for="mother_name">Mother's Name:</label>
      <input type="text" id="mother_name" name="mother_name" required>

      <label for="mother_living">Is Mother Living?</label>
      <select id="mother_living" name="mother_living" required>
        <option value="">Select an option</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>

      <label for="mother_education_level">Mother's Education Level:</label>
      <input type="text" id="mother_education_level" name="mother_education_level">

      <label for="guardian_name">Guardian's Name:</label>
      <input type="text" id="guardian_name" name="guardian_name" required>

      <label for="guardian_education_level">Guardian's Education Level:</label>
      <input type="text" id="guardian_education_level" name="guardian_education_level">

      <label for="birthdate">Birthdate:</label>
      <input type="date" id="birthdate" name="birthdate">

      <label for="current_employment">Current Employment:</label>
      <input type="text" id="current_employment" name="current_employment">

      <label for="num_siblings">Number of Siblings:</label>
      <input type="number" id="num_siblings" name="num_siblings" min="0" required>

      <h2>Siblings</h2>

      <label for="sibling1_name">Sibling 1 Name:</label>
      <input type="text" id="sibling1_name" name="sibling1_name">

      <label for="sibling1_age">Sibling 1 Age:</label>
      <input type="number" id="sibling1_age" name="sibling1_age" min="0">

      <label for="sibling2_name">Sibling 2 Name:</label>
      <input type="text" id="sibling2_name" name="sibling2_name">

      <label for="sibling2_age">Sibling 2 Age:</label>
      <input type="number" id="sibling2_age" name="sibling2_age" min="0">

      <label for="sibling3_name">Sibling 3 Name:</label>
      <input type="text" id="sibling3_name" name="sibling3_name">

      <label for="sibling3_age">Sibling 3 Age:</label>
      <input type="number" id="sibling3_age" name="sibling3_age" min="0">

       <label for="general_comment">Student's General comment:</label>
      <input type="text" id="general_comment" name="general_comment">


      <button type="submit">Save</button>
    </form>
  </div>
</body>
</html>
