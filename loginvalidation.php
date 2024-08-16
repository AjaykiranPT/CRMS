<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        // Get the user input
        $input_email = $_POST['login_email'];
        $input_password = $_POST['login_password'];


        // Include the database connection file
        include 'connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // Prepare the SQL statement
        $stmt = $conn->prepare("SELECT account_password,account_type FROM account_login WHERE account_email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param('s', $input_email);
        $stmt->execute();
        $stmt->bind_result($stored_password,$stored_type);


        if ($stmt->fetch()) {
            // Verify the password
            if (password_verify($input_password, $stored_password)) {
                if($stored_type === 'admin'){
                    header("location:Admin/index.php");
                }
                elseif($stored_type === 'student'){
                    header("location:Student/index.php");
                }
                elseif($stored_type === 'company'){
                    header("location:Company/index.php");
                }
                else{
                    $error_message = urldecode('User not found');
                    header("Location: login.php?error=$error_message");
                    exit();
                }
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