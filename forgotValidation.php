<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
    $email = $_POST['forgot_email'];
    $enteredPhone = $_POST['forgot_phone'];
    $newPassword = $_POST['forgot_password'];


        include 'connection.php';
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



        $stmt = $conn->prepare("SELECT account_type FROM account_login WHERE account_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();


        if ($stmt->num_rows == 0) {
            echo "<script> alert('Account not fount.') </script>";
        }


        $stmt->bind_result($accountType);
        $stmt->fetch();
        $stmt->close();

        if ($accountType == 'student') {
            $stmt = $conn->prepare("SELECT PhoneNum FROM student_details WHERE account_email = ?");
        } else if ($accountType == 'company') {
            $stmt = $conn->prepare("SELECT PhoneNum FROM company_details WHERE account_email = ?");
        } else {
            echo "<script> alert('invalid user.') </script>";
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($storedPhone);
        $stmt->fetch();
        $stmt->close();

        if ($enteredPhone !== $storedPhone) {
            echo "<script> alert('Phone number does not match.') </script>";
        }

        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT); // Hash the new password
        $stmt = $conn->prepare("UPDATE account_login SET account_password = ? WHERE account_email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            header("location:login.php?message=Password changed successfully");
        } else {
            echo "<script> alert('Error updating password.') </script>";
        }
    }
?>