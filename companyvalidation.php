<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $companyname = trim($_POST['companyname']);
    $contactperson = trim($_POST['contactperson']);
    $email = trim($_POST['email']);
    $phonenum = trim($_POST['phonenum']);
    $regid = trim($_POST['regid']);
    
    //include Connection
    include 'connection.php';

        // Ensure the connection is still valid
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    // Validate the input
    $errors = [];

    if (empty($companyname)) {
        $errors[] = "Company Name is required";
    }

    if (empty($contactperson)) {
        $errors[] = "Contact Person Name is required";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (!preg_match('/^[0-9]{10}$/', $phonenum)) {
        $errors[] = "Phone number must be 10 digits";
    }
    if (empty($errors)) {
         // Inserting data into Table
        // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Company (RegID,CompanyName,ContactPerson,Email,Phone) VALUES (?,?,?,?,?)");
    $stmt->bind_param("sssss", $regid,$companyname,$contactperson,$email,$phonenum);
    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('New Company created successfully');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo $error ;
        }
    }
}

?>