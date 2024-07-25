<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['mail']);
    $phonenum = trim($_POST['phonenum']);
    
    //include Connection
    include 'connection.php';

    // Validate the input
    $errors = [];

    if (empty($fname)) {
        $errors[] = "First Name is required";
    }

    if (empty($lname)) {
        $errors[] = "Last Name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (!preg_match('/^[0-9]{10}$/', $phonenum)) {
        $errors[] = "Phone number must be 10 digits";
    }

    // If there are no errors, proceed with processing the form
    if (empty($errors)) {
        // Process the form data (e.g., save to the database)
        echo "Form submission successful!";
    } else {
        // Display the errors
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
