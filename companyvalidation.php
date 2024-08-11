<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $companyname = trim($_POST['companyname']);
    $contactperson = trim($_POST['contactperson']);
    $email = trim($_POST['companyemail']);
    $phonenum = trim($_POST['companyphonenum']);   
    $password= trim($_POST['password']);
    $account_type='company';
    
    //include Connection
    include 'connection.php';

        // Ensure the connection is still valid
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    // Validate the input
    $acc_check = $conn->prepare("SELECT * FROM company_detatils WHERE account_email= ? ");
    $acc_check->bind_param("s",$email);
    $acc_check->execute();
    $acc_check->store_result();
    if($acc_check->num_rows>0){
        echo "<script> alert('This email already registered.') </script>";
        $acc_check->close();
    }
    else{
         // Inserting data into Table
        // Prepare and bind
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);   
        $stmt = $conn->prepare("INSERT INTO company_detatils (Company_name,Contact_person,account_email,PhoneNum) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$companyname,$contactperson,$email,$phonenum);
        $inst=$conn->prepare("INSERT INTO account_login (account_email,account_password,account_type) VALUES(?,?,?)");
        $inst->bind_param("sss",$email,$hashed_password,$account_type);
        // Execute the statement

        if ( $inst->execute()) {
            echo "<script>alert('New Company created successfully');</script>";
            header("location:login.php?message=Account created successfully");
            $stmt->execute();
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }
        $stmt->close();
        $inst->close();
        $conn->close();
    } 
}

?>