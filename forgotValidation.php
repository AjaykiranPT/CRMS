<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // Get the user input
        $forgot_email = $_POST['forgot_email'];
        $forgot_phone = $_POST['forgot_phone'];
        $forgot_password = $_POST['forgot_password'];


        // Include the database connection file
        include 'connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT account_type FROM account_login WHERE account_email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param('s', $forgot_email);
        $stmt->execute();
        $stmt->bind_result($stored_type);


        if ($stmt->fetch()) {
            
            elseif($stored_type === 'student'){
                $stmt = $conn->prepare("student_detatils WHERE account_email = ? AND PhoneNum=?");
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param('ss', $forgot_email, $forgot_phone);
                $stmt->execute();
                $stmt->bind_result($stored_type);
            }
            elseif($stored_type === 'company'){
                $stmt = $conn->prepare("SELECT account_type FROM account_login WHERE account_email = ?");
                if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param('s', $forgot_email);
                $stmt->execute();
                $stmt->bind_result($stored_type);
            }
            else{
                $error_message = urldecode('User not found');
                header("Location: login.php?error=$error_message");
                exit();
            }
            if (password_verify($input_password, $stored_password)) {
                
            }   
            else {
                $error_message = urldecode('Incorrect password. Please try again.');
                header("Location: login.php?error=$error_message");
                exit();    
            }
        }
        else {
            $error_message = urldecode('User not found');
            header("Location: login.php?error=$error_message");
            exit();
        }


        // Close the connections
        $stmt->close();
        $conn->close();
    }
?>