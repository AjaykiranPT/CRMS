<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['mail']);
    $phonenum = trim($_POST['phonenum']);
    $department = trim($_POST['department']);
    $college = trim($_POST['college']);
    $year = trim($_POST['year']);
    
    //include Connection
    include 'connection.php';

        // Ensure the connection is still valid
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    

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
        // Inserting data into Table
        // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Students (FirstName,LastName,Email,Phone,Department,College,YearOfPassing) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssi", $fname,$lname,$email,$phonenum,$department,$college,$year);
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New User created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    
} else {
    // Display the errors
    foreach ($errors as $error) {
        echo "<script>alert('$error');</script>";
    }
}
    // Close connections
    $stmt->close();
    $conn->close();
}
?>
