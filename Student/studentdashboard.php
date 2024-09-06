!DOCTYPE html>
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
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="#">Dashboard</a></li>
            <li><a href="#">New Jobs</a></li>
            <li><a href="#">Track Application</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="#">Report</a></li>
        </ul>
    </div>
    
    <div class="main-container">
        <div class="dashboard-header">
            <h1>User Dashboard</h1>
        </div>
        <div class="dashboard-content">
            <div class="box box1">
                <h2>New Jobs</h2>
                <p>11</p>
            </div>
            <div class="box box2">
                <h2>Total Applied</h2>
                <p>8</p>
            </div>
            <div class="box box3">
                <h2>Today Upadated Job</h2>
                <p>1</p>
            </div>
            <!-- <div class="box box4">
                <h2>Application Rejected</h2>
                <p>35</p>
            </div> -->
        </div>
</body>
</html>
