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
                $stmt = $conn->prepare("SELECT PhoneNum FROM student_detatils WHERE account_email = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param('s', $forgot_email);
                $stmt->execute();
                $stmt->bind_result($stored_phone);
            }
            elseif($stored_type === 'company'){
                $stmt = $conn->prepare("SELECT PhoneNum FROM company_detatils WHERE account_email = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param('s', $forgot_email);
                $stmt->execute();
                $stmt->bind_result($stored_phone);
            }
            if($stored_phone.equals($forgot_phone)){
                $stmt = $conn->prepare("UPDATE account_login SET account_password= ? WHERE account_email = ?");
                if ($stmt === false) {
                    die("Prepare failed: " . $conn->error);
                }
                $stmt->bind_param('ss', $forgot_password, $forgot_email);
                $stmt->execute();   
            }
        }
        else {
            echo "<script>alert('User not found');</script>;";
        }


        // Close the connections
        $stmt->close();
        $conn->close();
    }
?>