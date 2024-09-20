<?php
session_start();
include "connection.php";

if (!isset($_SESSION['student_id'])) {
    header("Location: ../login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details
$stmt = $conn->prepare("SELECT * FROM student_details WHERE student_id = ?");
$stmt->bind_param("i", $student_id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];
    $course = $_POST['course'];
    $college = $_POST['college'];
    $year_of_passing = $_POST['year_of_passing'];
    $phone_num = $_POST['phone_num'];
    $account_email = $_POST['account_email'];

    $stmt = $conn->prepare("UPDATE student_details SET First_name = ?, Last_name = ?, Gender = ?, City = ?, Course = ?, College = ?, Year_of_passing = ?, PhoneNum = ?, account_email = ? WHERE student_id = ?");
    $stmt->bind_param("ssssssssi", $first_name, $last_name, $gender, $city, $course, $college, $year_of_passing, $phone_num, $account_email, $student_id);
    
    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }
        
        h1 {
            margin-bottom: 20px;
            color: #2f5fff;
        }
        
        /* Form Styles */
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #2f5fff;
            outline: none;
        }
        
        button {
            background-color: #2f5fff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        
        /* Responsive Styles */
        @media (max-width: 600px) {
            form {
                padding: 15px;
            }
        
            h1 {
                font-size: 1.5em;
            }
        }
        
    </style>
</head>
<body>
    <h1>Student Profile</h1>
    <form method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?= htmlspecialchars($student['First_name']); ?>" required>
        
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?= htmlspecialchars($student['Last_name']); ?>" required>
        
        <label for="gender">Gender:</label>
        <input type="text" name="gender" value="<?= htmlspecialchars($student['Gender']); ?>" required>
        
        <label for="city">City:</label>
        <input type="text" name="city" value="<?= htmlspecialchars($student['City']); ?>" required>
        
        <label for="course">Course:</label>
        <input type="text" name="course" value="<?= htmlspecialchars($student['Course']); ?>" required>
        
        <label for="college">College:</label>
        <input type="text" name="college" value="<?= htmlspecialchars($student['College']); ?>" required>
        
        <label for="year_of_passing">Year of Passing:</label>
        <input type="text" name="year_of_passing" value="<?= htmlspecialchars($student['Year_of_passing']); ?>" required>
        
        <label for="phone_num">Phone Number:</label>
        <input type="text" name="phone_num" value="<?= htmlspecialchars($student['PhoneNum']); ?>" required>
        
        <label for="account_email">Email:</label>
        <input type="email" name="account_email" value="<?= htmlspecialchars($student['account_email']); ?>" required>
        
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
