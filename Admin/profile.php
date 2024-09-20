<?php
session_start();
include "connection.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

$admin_id = $_SESSION['admin_id'];

// Fetch admin details
$stmt = $conn->prepare("SELECT * FROM admin_details WHERE admin_id = ?");
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$admin = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $account_email = $_POST['account_email'];
    $user_name = $_POST['user_name'];
    $phone_num = $_POST['phone_num'];

    $stmt = $conn->prepare("UPDATE admin_details SET account_email = ?, user_name = ?, PhoneNum = ? WHERE admin_id = ?");
    $stmt->bind_param("sssi", $account_email, $user_name, $phone_num, $admin_id);
    
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
    <title>Admin Profile</title>
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
    <h1>Admin Profile</h1>
    <form method="POST">
        <label for="account_email">Email:</label>
        <input type="email" name="account_email" value="<?= htmlspecialchars($admin['account_email']); ?>" required>
        
        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" value="<?= htmlspecialchars($admin['user_name']); ?>" required>
        
        <label for="phone_num">Phone Number:</label>
        <input type="text" name="phone_num" value="<?= htmlspecialchars($admin['PhoneNum']); ?>" required>
        
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
