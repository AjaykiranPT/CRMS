<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $fname = trim($_POST['studentfname']);
    $lname = trim($_POST['studentlname']);
    $gender= trim($_POST['gender']);
    $city = trim($_POST['studentcity']);
    $course = trim($_POST['course']);
    $college = trim($_POST['college']);
    $year = trim($_POST['yearofpassing']);
    $phonenum = trim($_POST['studentphonenum']);
    $email = trim($_POST['studentemail']);
    $password= trim($_POST['studentpassword']);
    $account_type="student";
    
    //include Connection
    include 'connection.php';

        // Ensure the connection is still valid
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $acc_check = $conn->prepare("SELECT * FROM student_detatils WHERE account_email= ? ");
    $acc_check->bind_param("s",$email);
    $acc_check->execute();
    $acc_check->store_result();
    if($acc_check->num_rows>0){
        echo "<script> alert('This email already registered.') </script>";
        $acc_check->close();
    }
   
    // If there are no errors, proceed with processing the form
    else{
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);   
        $stmt = $conn->prepare("INSERT INTO student_detatils (First_name,Last_name,Gender,City,Course,College,Year_of_passing,PhoneNum,account_email) VALUES (?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("sssssssss",$fname,$lname,$gender,$city,$course,$college,$year,$phonenum,$email);
        $inst=$conn->prepare("INSERT INTO account_login (account_email,account_password,account_type) VALUES(?,?,?)");
        $inst->bind_param("sss",$email,$hashed_password,$account_type);
        // Execute the statement

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
        $conn->close();
    
    } 
} 

?>