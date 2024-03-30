<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $general_comment = $_POST["general_comment"];

    // Here, you can process the form data for the general comment.
    // For example, you can save the comment to a database or perform other operations.

    // After processing, you can redirect back to the form page or show a success message.
    header("Location: form_page.php?general_comment_success=1");
    exit();
}
?>
