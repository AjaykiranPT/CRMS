<?php
    $adminusername = "Anin M S";
    $phonenum = "6238474286";
    $email = "abinms@gmail.com";
    $adminpassword= "Abinms@1234";
    $account_type="admin";
    

    include 'connection.php';
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    

    $acc_check = $conn->prepare("SELECT * FROM account_login WHERE account_email= ? ");
    $acc_check->bind_param("s",$email);
    $acc_check->execute();
    $acc_check->store_result();
    if($acc_check->num_rows>0){
        echo "<script> alert('This email already registered.') </script>";
        $acc_check->close();
    }
   
    
    else{
        $hashed_password = password_hash($adminpassword, PASSWORD_BCRYPT);   
        $stmt = $conn->prepare("INSERT INTO admin_details (account_email,user_name,PhoneNum) VALUES (?,?,?)");
        $stmt->bind_param("sss",$email,$adminusername,$phonenum);
        $inst=$conn->prepare("INSERT INTO account_login (account_email,account_password,account_type) VALUES(?,?,?)");
        $inst->bind_param("sss",$email,$hashed_password,$account_type);


        if ( $inst->execute()) {
            $stmt->execute();
            header("location:login.php?message=Account created successfully");
            
        } else {
            echo "
            <script>
                alert('Error:' . $stmt->error .$inst->error);
            </script>;
            ";
        }


        $stmt->close();
        $inst->close();
    }
    $conn->close(); 