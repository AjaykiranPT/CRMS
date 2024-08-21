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
            grid-template-columns: repeat(2, 1fr); /* Three boxes per row */
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
    
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Menu</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="manageCompany.php">Manage Company </a></li>
            <li><a href="application.php">Manage Applications</a></li>
            <li><a href="manageUser.php">Manage Users</a></li>
            <li><a href="#">Report</a></li>
            <li><a href="#">Settings</a></li>
        </ul>
    </div>

    <div class="main-container">
        <div class="dashboard-header">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="dashboard-content">
            <div class="box box1" onclick ="showCompanies()">
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
    </div>
</body>
</html>
