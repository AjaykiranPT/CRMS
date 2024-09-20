<?php
session_start();
include "connection.php";

if (!isset($_SESSION['company_id'])) {
    header("Location: ../login.php");
    exit();
}

$company_id = $_SESSION['company_id'];

// Fetch company details
$stmt = $conn->prepare("SELECT * FROM company_details WHERE company_id = ?");
$stmt->bind_param("i", $company_id);
$stmt->execute();
$company = $stmt->get_result()->fetch_assoc();
$stmt->close();

// Handle update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $company_name = $_POST['company_name'];
    $contact_person = $_POST['contact_person'];
    $account_email = $_POST['account_email'];
    $phone_num = $_POST['phone_num'];

    $stmt = $conn->prepare("UPDATE company_details SET Company_name = ?, Contact_person = ?, account_email = ?, PhoneNum = ? WHERE company_id = ?");
    $stmt->bind_param("ssssi", $company_name, $contact_person, $account_email, $phone_num, $company_id);
    
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
    <title>Company Profile</title>
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
    <h1>Company Profile</h1>
    <form method="POST">
        <label for="company_name">Company Name:</label>
        <input type="text" name="company_name" value="<?= htmlspecialchars($company['Company_name']); ?>" required>
        
        <label for="contact_person">Contact Person:</label>
        <input type="text" name="contact_person" value="<?= htmlspecialchars($company['Contact_person']); ?>" required>
        
        <label for="account_email">Email:</label>
        <input type="email" name="account_email" value="<?= htmlspecialchars($company['account_email']); ?>" required>
        
        <label for="phone_num">Phone Number:</label>
        <input type="text" name="phone_num" value="<?= htmlspecialchars($company['PhoneNum']); ?>" required>
        
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
