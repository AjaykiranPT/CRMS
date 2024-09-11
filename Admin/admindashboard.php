<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a; /* Dark background */
            display: flex;
            color: #ccc;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            padding: 20px;
            position: fixed;
            height: 100vh;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }

        .sidebar h2 {
            color: #00ff00; /* Green color for heading */
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: #ccc;
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #00ff00; /* Green color on hover */
        }

        .main-container {
            margin-left: 270px;
            padding: 20px;
            background-color: #1a1a1a; /* Dark background */
            color: #ccc;
            width: calc(100% - 290px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 2.5em;
            color: #00ff00; /* Green color for heading */
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* Two boxes per row */
            gap: 20px;
        }

        .box {
            background-color: #2a2a2a;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .box h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #00ff00; /* Green color for box heading */
        }

        .box p {
            font-size: 1.2em;
            color: #ccc;
        }

        .box1 {
            background: linear-gradient(135deg, #004d00, #002600); /* Green gradient */
        }

        .box2 {
            background: linear-gradient(135deg, #003d00, #001a00); /* Darker green gradient */
        }

        .box3 {
            background: linear-gradient(135deg, #003000, #001000); /* Even darker green gradient */
        }

        .box4 {
            background: linear-gradient(135deg, #002200, #000800); /* Dark green gradient */
        }

        /* Profile Settings Styling */
        .center-box {
            background-color: #1e90ff; /* Blue background */
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            margin: 20px auto;
            display: none; /* Hidden by default */
        }

        button {
            background-color: #000; /* Black background */
            color: #fff; /* White text */
            border: 2px solid #1e90ff; /* Blue border */
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 0;
            transition: background-color 0.3s ease;
            width: 100%;
            border-radius: 4px;
        }

        button:hover {
            background-color: #1e90ff; /* Blue on hover */
            color: #000; /* Black text on hover */
        }

        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #000; /* Black border */
            border-radius: 4px;
            background-color: #333; /* Dark input background */
            color: #fff; /* White text */
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="#" onclick="showDashboard()">Dashboard</a></li>
            <li><a href="manageCompany.php">Manage Company</a></li>
            <li><a href="application.php">Manage Applications</a></li>
            <li><a href="manageUser.php">Manage Users</a></li>
            <li><a href="#">Report</a></li>
            <li><a href="#" onclick="showSettings()">Settings</a></li>
        </ul>
    </div>

    <div class="main-container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="dashboard-content" id="dashboardContent">
            <div class="box box1">
                <h2> Registered Company</h2>
                <p>12</p>
            </div>
            <div class="box box2">
                <h2>Registered Users</h2>
                <p>135</p>
            </div>
            <div class="box box3">
                <h2>Job Posted</h2>
                <p>50</p>
            </div>
            <div class="box box4">
                <h2>Total Applications</h2>
                <p>25</p>
            </div>
        </div>

        <!-- Profile Settings Section -->
        <div class="center-box" id="settingsContent">
            <h2>Profile Settings</h2>
            <button onclick="showChangePasswordForm()">Change Password</button>
            <button onclick="logout()">Logout</button>

            <div id="changePasswordForm" style="display: none;">
                <h3>Change Password</h3>
                <form action="" method="POST">
                    <input type="password" name="new_password" placeholder="New Password" required><br>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
                    <button type="submit">Update Password</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showDashboard() {
            document.getElementById('dashboardContent').style.display = 'grid';
            document.getElementById('settingsContent').style.display = 'none';
        }

        function showSettings() {
            document.getElementById('dashboardContent').style.display = 'none';
            document.getElementById('settingsContent').style.display = 'block';
        }

        function showChangePasswordForm() {
            document.getElementById('changePasswordForm').style.display = 'block';
        }

        function logout() {
            window.location.href = '../login.php'; // Redirect to logout page
        }
    </script>
<?php
 include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Validate that the new password matches the confirm password
    if ($new_password === $confirm_password) {
        // Password hash for security (You can adjust hashing based on your need)
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

               // session_start();
        // $user_id = $_SESSION['user_id'];  // Replace with actual user ID logic

        // Update query
        // $sql = "UPDATE account_login SET account_password='$hashed_password' WHERE account_email= $user_id";

        // if ($conn->query($sql) === TRUE) {
        //     echo "<script>alert('Password updated successfully!');</script>";
        // } else {
        //     echo "Error updating password: " . $conn->error;
        // }
    } else {
        echo "<script>alert('Passwords do not match!');</script>";
    }

}
$conn->close();
?>
</body>
</html>
