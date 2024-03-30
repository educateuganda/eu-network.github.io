<!DOCTYPE html>
<html>
<head>
  <title>Student Family Information</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url("img/background.jpg"); /* Replace "img/background.jpg" with the path to your background image */
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

    .general-comment-container {
      max-width: 600px;
      margin: 20px auto;
      background-color: #f2f2f2;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    .general-comment-container label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .general-comment-container input[type="text"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <h1>Student Family Information</h1>
  <div class="form-container">
    <form action="save_family_information.php" method="post">
      <label for="student_code">Student Code:</label>
      <input type="text" id="student_code" name="student_code" required>

      <!-- ... (rest of the form fields) ... -->

      <button type="submit">Save</button>
    </form>
  </div>

  <div class="general-comment-container">
    <form action="save_general_comment.php" method="post">
      <label for="general_comment">Student's General Comment:</label>
      <input type="text" id="general_comment" name="general_comment">

      <button type="submit">Save General Comment</button>
    </form>
  </div>
</body>
</html>
