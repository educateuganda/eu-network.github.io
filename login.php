<?php
// Check if there is an error message in the URL parameter
$error = isset($_GET['error']) ? $_GET['error'] : '';

// Display the error message if present
if (!empty($error)) {
    echo "<p class='error'>$error</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login - Educate Uganda Students Network</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    /* Custom styles for the login page */

    body {
      background-image: url('img/loginbg.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      font-family: Arial, sans-serif;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    main {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 10px;
      font-weight: bold;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 10px;
    }

    button[type="submit"] {
      background-color: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #555;
    }

    p {
      margin-top: 10px;
    }

    p a {
      color: #333;
    }

    .error {
      color: red;
      font-weight: bold;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Login</h1>
  </header>
  <main>
    <form action="login_process.php" method="POST">
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <!--label for="is_admin">Admin:</label
      <input type="checkbox" id="is_admin" name="is_admin"-->

      <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="registrationpage.html">Sign up</a></p> <!-- Added sign-up link -->
  </main>
  <footer>
    <!-- Footer content -->
  </footer>
</body>
</html>
