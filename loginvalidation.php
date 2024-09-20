<?php
session_start(); // Start the session at the beginning of the script

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get the user input
    $input_email = $_POST['login_email'];
    $input_password = $_POST['login_password'];

    // Include the database connection file
    include 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement to get user details
    $stmt = $conn->prepare("SELECT account_password, account_type FROM account_login WHERE account_email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param('s', $input_email);
    $stmt->execute();
    $stmt->bind_result($stored_password, $stored_type);

    // If a user is found
    if ($stmt->fetch()) {
        // Verify the password (hashed or plain text based on your earlier setup)
        if (password_verify($input_password, $stored_password) || $input_password === $stored_password) {

            // Close the first statement before moving on to the next query
            $stmt->close();

            // Admin login handling (No approval check needed for admin)
            if ($stored_type === 'admin') {
                $admin_stmt = $conn->prepare("SELECT id FROM admin_details WHERE account_email = ?");
                if ($admin_stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $admin_stmt->bind_param('s', $input_email);
                $admin_stmt->execute();
                $admin_stmt->bind_result($stored_id);
                if ($admin_stmt->fetch()) {
                    $_SESSION['admin_id'] = $stored_id; // Set session for admin_id
                    header("Location: Admin/dashboard.php");
                    exit();
                }
                $admin_stmt->close(); // Always close the statement
            } 
            
            // Student login handling with approval check
            elseif ($stored_type === 'student') {
                $student_stmt = $conn->prepare("SELECT student_id, approved FROM student_details WHERE account_email = ?");
                if ($student_stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $student_stmt->bind_param('s', $input_email);
                $student_stmt->execute();
                $student_stmt->bind_result($stored_id, $approval_status);
                if ($student_stmt->fetch()) {
                    if ($approval_status === 'approved') {
                        $_SESSION['student_id'] = $stored_id; // Set session for student_id
                        header("Location: Student/index.php");
                    } elseif ($approval_status === 'pending') {
                        $error_message = urldecode('Your account is pending approval.');
                        header("Location: login.php?error=$error_message");
                    } else {
                        $error_message = urldecode('Your account has been rejected.');
                        header("Location: login.php?error=$error_message");
                    }
                    exit();
                }
                $student_stmt->close(); // Always close the statement
            } 
            
            // Company login handling with approval check
            elseif ($stored_type === 'company') {
                $company_stmt = $conn->prepare("SELECT Company_id, approval FROM company_details WHERE account_email = ?");
                if ($company_stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $company_stmt->bind_param('s', $input_email);
                $company_stmt->execute();
                $company_stmt->bind_result($stored_id, $approval_status);
                if ($company_stmt->fetch()) {
                    if ($approval_status === 'approved') {
                        $_SESSION['company_id'] = $stored_id; // Set session for company_id
                        header("Location: Company/dashboard.php");
                    } elseif ($approval_status === 'pending') {
                        $error_message = urldecode('Your account is pending approval.');
                        header("Location: login.php?error=$error_message");
                    } else {
                        $error_message = urldecode('Your account has been rejected.');
                        header("Location: login.php?error=$error_message");
                    }
                    exit();
                }
                $company_stmt->close(); // Always close the statement
            } 
            
            // Invalid user type
            else {
                $error_message = urldecode('Invalid user type.');
                header("Location: login.php?error=$error_message");
                exit();
            }
        } else {
            // Incorrect password
            $error_message = urldecode('Incorrect password. Please try again.');
            header("Location: login.php?error=$error_message");
            exit();
        }
    } else {
        // User not found
        $error_message = urldecode('User not found.');
        header("Location: login.php?error=$error_message");
        exit();
    }

    // Close the connections if not already closed
    if ($stmt) {
        $stmt->close();
    }
    $conn->close();
}
?>
