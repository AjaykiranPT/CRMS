<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #222; /* Dark background */
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: #333;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
            position: fixed;
            height: 100vh;
        }

        .sidebar h2 {
            color: #00aaff;
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
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #00aaff;
        }

        .main-container {
            margin-left: 270px; /* Adjusted to account for the sidebar */
            padding: 20px;
            background-color: #333;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: calc(100% - 290px); /* Adjusting width considering sidebar */
            color: #ccc; /* Default text color */
        }

        .dashboard-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            font-size: 2.5em;
            color: #00aaff;
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 equal columns */
            grid-template-rows: auto auto; /* 2 rows */
            gap: 20px; /* Spacing between boxes */
        }

        .box {
            background-color: #444;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .box:hover {
            transform: translateY(-5px);
        }

        .box h2 {
            font-size: 1.5em;
            margin-bottom: 10px;
            color: #00aaff;
        }

        .box p {
            font-size: 1.2em;
            color: #ccc;
        }

        .box1 {
            background-color: #005f8b;
        }

        .box2 {
            background-color: #004466;
        }

        .box3 {
            background-color: #00334d;
        }

        .box4 {
            background-color: #002235;
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
        <h2>Menu</h2>
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="application.php">Applications</a></li>
            <li><a href="postVacancy.php">Post Vacancy</a></li>
            <li><a href="#" onclick="showSettings()">Settings</a></li> <!-- Link to settings -->
            <li><a href="#">Report</a></li>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="dashboard-header">
            <h1>Company Dashboard</h1>
        </div>
        <div class="dashboard-content" id="dashboardContent">
            <div class="box box1">
                <h2>Total Applications</h2>
                <p>150</p>
            </div>
            <div class="box box2">
                <h2>Today Received</h2>
                <p>85</p>
            </div>
            <div class="box box3">
                <h2>Applications Selected</h2>
                <p>40</p>
            </div>
            <div class="box box4">
                <h2>Application Rejected</h2>
                <p>35</p>
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
            window.location.href = '../login.php'; // Redirect to login or logout page
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

        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            session_start();
            $user_id = $_SESSION['user_id']; // Ensure this is set

            $sql = "UPDATE account_login SET account_password='$hashed_password' WHERE account_email='$user_id'";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Password updated successfully!');</script>";
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            echo "<script>alert('Passwords do not match!');</script>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
