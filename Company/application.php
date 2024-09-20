<?php
session_start();
include "connection.php";

if (!isset($_SESSION['company_id'])) {
    header("Location: ../login.php");
    exit();
}

$company_id = $_SESSION['company_id'];

// Handle approval, rejection, and removal of approval
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_id = $_POST['application_id'];
    $action = $_POST['action'];

    if ($action === 'approve') {
        $stmt = $conn->prepare("UPDATE application SET application_status = 'approved' WHERE application_id = ?");
        $stmt->bind_param("i", $application_id);
    } elseif ($action === 'reject') {
        $stmt = $conn->prepare("UPDATE application SET application_status = 'rejected' WHERE application_id = ?");
        $stmt->bind_param("i", $application_id);
    } elseif ($action === 'remove_approval') {
        $stmt = $conn->prepare("UPDATE application SET application_status = 'pending' WHERE application_id = ?");
        $stmt->bind_param("i", $application_id);
    }

    $stmt->execute();
    $stmt->close();
}

// Fetch applications
$query = "
    SELECT a.application_id, a.application_status, s.First_name, j.jobtitle, s.student_id 
    FROM application a
    JOIN student_details s ON a.student_id = s.student_id
    JOIN job_posting j ON a.job_id = j.job_id
    WHERE a.Company_id = ? AND a.application_status = ?
";

$statuses = ['approved', 'pending', 'rejected'];
$applications = [];

foreach ($statuses as $status) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param("is", $company_id, $status);
    $stmt->execute();
    $result = $stmt->get_result();
    $applications[$status] = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            scroll-behavior: smooth;
            color: aliceblue;
            background-color: black;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        .header {
            display: flex;
            height: 60px;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            padding: 10px 50px;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #2f5fff;
            text-decoration: none;
        }

        .container {
            padding: 4rem;
            width: 95%;
            height: calc(100vh - 60px); /* Ensure it fills remaining space */
            margin: 15px;
            margin-top: 50px;
            border-radius: 10px 10px 0 0;
            background: #0d0d0d;
            text-align: center;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            row-gap: 0px;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 300px;
            height: 100vh;
            padding: 30px;
            background-color: #0d0d0d;
            border-right: 1px solid black;
            transform: translateX(-100%); /* Initially hidden */
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .sidebar.visible {
            transform: translateX(0); /* Show when visible */
        }

        .sidebar .close {
            display: flex;
            height: 70px;
            width: 100%;
            align-items: center;
        }

        .sidebar .close i {
            font-size: 2em;
            position: absolute;
            right: 10px;
            cursor: pointer;
        }

        .sidebar .bar {
            padding: 12px;
            margin-top: 19px;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 30px;
        }
        .sidebar .bar:hover{
            border: 1px solid white;
            color: white;
        }
        .sidebar .bar a {
            color: rgb(47, 95, 255);
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .sidebar .current {
            padding: 12px;
            margin-top: 19px;
            border-radius: 30px;
            color:white;
            background-color:rgb(47, 95, 255);
        }
        .sidebar .current a{
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
            
                /* Profile container to hold the profile icon and dropdown */
        .profile-container {
            position: relative;
            display: inline-block;
        }

        /* Hidden by default */
        .profile-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%; /* Position below the icon */
            background-color: #0d0d0d;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px;
            z-index: 1000;
            padding: 10px;
            width: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

        /* Links inside the profile menu */
        .profile-menu a {
            display: block;
            padding: 8px 15px;
            color: rgb(47, 95, 255);
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .profile-menu a:hover {
            background-color: rgba(47, 95, 255, 0.1);
            color: white;
        }

        /* Show profile menu when active */
        .profile-menu.active {
            display: block;
        }


        .menu-btn {
            background-color: transparent;
            outline: none;
            border: none;
        }

        #menu {
            font-size: 2em;
            color: #6b6464;
        }
        #profile{
            font-size: 1.5em;
            color: #6b6464;
        }
        /* Container for each list of companies */
        .application-list {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            border: 1px solid #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        
        .application-list h2 {
            color: #2f5fff;
            margin-bottom: 15px;
        }
        
        /* Individual company item styling */
        .application {
            background-color: #2d2d2d;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        .application span {
            font-size: 1.1em;
            color: #ffffff;
        }
        
        .application-actions form {
            display: inline;
        }
        
        .application-actions button {
            background-color: #2f5fff;
            border: none;
            color: #ffffff;
            padding: 5px 10px;
            margin-left: 5px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .application-actions button:hover {
            background-color: #1a3a7f;
        }
        
        /* Specific styling for rejected companies */
        .application-actions span {
            color: #ff5c5c;
            font-weight: bold;
        }
        
        
        /* Responsive CSS */
        @media (max-width: 1200px) {
            .container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 992px) {
            .container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 10px 30px;
            }

            .container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                width: 100%;
                transform: translateX(-100%);
            }

            .sidebar.visible {
                transform: translateX(0);
            }
        }

        @media (max-width: 576px) {
            .logo {
                font-size: 1.5rem;
            }

            #menu {
                font-size: 1.5em;
            }

            .container {
                padding: 2rem 0;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar" id="sidebar">
        <div class="close"><i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i></div>
        <div class="bar"><a href="dashboard.php">Dashboard</a></div>
        <div class="bar current"><a href="application.php">Applications</a></div>
        <div class="bar"><a href="postedVacancy.php">Job posted</a></div>
        <div class="bar"><a href="postVacancy.php">Post vacancy</a></div>
        <div class="bar"><a href="#">Profile</a></div>
    </div>

    <div class="main-container">
        <div class="header">
            <button class="menu-btn" onclick="toggleSidebar()"><i class="fa-solid fa-bars" id="menu"></i></button>
            <a href="#" class="logo">Campus Recruit</a>
            <div class="profile-container">
                <i class="fa-solid fa-user" id="profile" onclick="toggleProfileMenu()"></i>
                <div class="profile-menu" id="profileMenu">
                    <a href="profile.php">Profile</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Approved Applications -->
            <div class="application-list">
                <h2>Approved Applications</h2>
                <?php foreach ($applications['approved'] as $application): ?>
                    <div class="application">
                        <span>
                        <a href="studentDetails.php?student_id=<?= $application['student_id']; ?>&application_id=<?= $application['application_id']; ?>">
                                <?= htmlspecialchars($application['First_name']); ?>
                            </a> applied for <?= htmlspecialchars($application['jobtitle']); ?>
                        </span>
                        <div class="application-actions">
                            <form method="POST">
                                <input type="hidden" name="application_id" value="<?= $application['application_id']; ?>">
                                <input type="hidden" name="action" value="remove_approval">
                                <button type="submit">Remove Approval</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pending Applications -->
            <div class="application-list">
                <h2>Waiting Applications</h2>
                <?php foreach ($applications['pending'] as $application): ?>
                    <div class="application">
                        <span>
                            <a href="studentDetails.php?student_id=<?= $application['student_id']; ?>&application_id=<?= $application['application_id']; ?>">
                                <?= htmlspecialchars($application['First_name']); ?>
                            </a> applied for <?= htmlspecialchars($application['jobtitle']); ?>
                        </span>
                        <div class="application-actions">
                            <form method="POST">
                                <input type="hidden" name="application_id" value="<?= $application['application_id']; ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit">Approve</button>
                            </form>
                            <form method="POST">
                                <input type="hidden" name="application_id" value="<?= $application['application_id']; ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit">Reject</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Rejected Applications -->
            <div class="application-list">
                <h2>Rejected Applications</h2>
                <?php foreach ($applications['rejected'] as $application): ?>
                    <div class="application">
                        <span>
                            <a href="studentDetails.php?student_id=<?= $application['student_id']; ?>&application_id=<?= $application['application_id']; ?>">
                                <?= htmlspecialchars($application['First_name']); ?>
                            </a> applied for <?= htmlspecialchars($application['jobtitle']); ?>
                        </span>
                        <div class="application-actions">
                            <span>Rejected</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('visible');
        }
        
        function toggleProfileMenu() {
            document.getElementById('profileMenu').classList.toggle('active');
        }

        window.onclick = function(event) {
            if (!event.target.matches('#profile')) {
                const dropdowns = document.getElementsByClassName("profile-menu");
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('active')) {
                        openDropdown.classList.remove('active');
                    }
                }
            }
        }
    </script>
</body>
</html>