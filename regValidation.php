<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $fname = trim($_POST['userfname']);
    $lname = trim($_POST['userlname']);
    $email = trim($_POST['useremail']);
    $phonenum = trim($_POST['userphonenum']);
    $course = trim($_POST['course']);
    $college = trim($_POST['college']);
    $year = trim($_POST['yearpassing']);
    $gender= trim($_POST['gender']);
    $city = trim($_POST['usercity']);
    $password= trim($_POST['userpassword']);

    
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
        $hashed_password = password_hash($password, PASSWORD_BCRYPT); 
        // Inserting data into Table
        // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO Students (FirstName,LastName,Email,Phone,Gender,Course,College,YearOfPassing,City,Password) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssiss", $fname,$lname,$email,$phonenum,$gender,$course,$college,$year,$city,$hashed_password);
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
