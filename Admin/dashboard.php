<?php
    include "connection.php";
    session_start();
    // Check if the user is logged in
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to login page if not logged in
        header("Location: ../login.php");
        exit(); // Stop further script execution
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            grid-template-columns: repeat(4, 1fr);
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
        .sidebar .current {
            padding: 12px;
            margin-top: 19px;
            border-radius: 30px;
            color:white;
            background-color:rgb(47, 95, 255);
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
        .sidebar .current a{
            color: white;
            text-decoration: none;
            font-size: 1.2em;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .feature {
            height: 150px;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px;
            width: 100%;
            display: flex;
            flex-direction: column; /* Stack items vertically */
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            background-color: #1a1a1a;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 10px;
            cursor: pointer;
        }
        .feature:hover {
            transform: scale(1.02); /* Slight zoom on hover */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.7);
        }
        .feature h2 {
            font-size: 1.2rem;
            color: #2f5fff;
            margin-bottom: 10px; /* Space between the heading and the number */
            font-weight: normal;
            text-transform: capitalize;
            text-align: center;
        }

        .feature p {
            font-size: 3rem;
            color: #ffffff;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
            text-align: center;
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
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar current">
            <a href="dashboard.php" >Dashboard</a>
        </div>
        <div class="bar">
            <a href="manageCompany.php">Manage Company</a>
        </div>
        <div class="bar">
            <a href="manageStudent.php">Manage Users</a>
        </div>
        <div class="bar">
            <a href="profile.php">Profile</a>
        </div>
    </div>

    <div class="main-container">
    <div class="header">
    <button class="menu-btn" onclick="toggleSidebar()">
        <i class="fa-solid fa-bars" id="menu"></i>
    </button>
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
            <!-- Registered Company Feature -->
            <div class="feature" onclick="window.location.href = 'manageCompany.php'">
                <h2>Registered Company</h2>
                <p>
                    <?php
                    $registeredCompanyQuery = "SELECT COUNT(*) as registered_companies FROM company_details WHERE approval = 'approved'";
                    $registeredCompanyResult = $conn->query($registeredCompanyQuery)->fetch_assoc();
                    echo $registeredCompanyResult['registered_companies'];
                    ?>
                </p>
            </div>
            <!-- Rejected Company Feature -->
            <div class="feature" onclick="window.location.href = 'manageCompany.php'">
                <h2>Rejected Company</h2>
                <p>
                    <?php
                    $rejectedCompanyQuery = "SELECT COUNT(*) as rejected_companies FROM company_details WHERE approval = 'rejected'";
                    $rejectedCompanyResult = $conn->query($rejectedCompanyQuery)->fetch_assoc();
                    echo $rejectedCompanyResult['rejected_companies'];
                    ?>
                </p>
            </div>
            <!-- New Company Feature -->
            <div class="feature" onclick="window.location.href = 'manageCompany.php'">
                <h2>New Company</h2>
                <p>
                    <?php
                    $newCompanyQuery = "SELECT COUNT(*) as new_companies FROM company_details WHERE approval = 'waiting'";
                    $newCompanyResult = $conn->query($newCompanyQuery)->fetch_assoc();
                    echo $newCompanyResult['new_companies'];
                    ?>
                </p>
            </div>
            <!-- Registered Students Feature -->
            <div class="feature" onclick="window.location.href = 'manageStudent.php'">
                <h2>Registered Students</h2>
                <p>
                    <?php
                    $registeredStudentQuery = "SELECT COUNT(*) as registered_students FROM student_details WHERE approval = 'approved'";
                    $registeredStudentResult = $conn->query($registeredStudentQuery)->fetch_assoc();
                    echo $registeredStudentResult['registered_students'];
                    ?>
                </p>
            </div>
            <!-- Rejected Students Feature -->
            <div class="feature" onclick="window.location.href = 'manageStudent.php'">
                <h2>Rejected Students</h2>
                <p>
                    <?php
                    $rejectedStudentQuery = "SELECT COUNT(*) as rejected_students FROM student_details WHERE approval = 'rejected'";
                    $rejectedStudentResult = $conn->query($rejectedStudentQuery)->fetch_assoc();
                    echo $rejectedStudentResult['rejected_students'];
                    ?>
                </p>
            </div>
            <!-- New Students Feature -->
            <div class="feature" onclick="window.location.href = 'manageStudent.php'">
                <h2>New Students</h2>
                <p>
                    <?php
                    $newStudentQuery = "SELECT COUNT(*) as new_students FROM student_details WHERE approval = 'waiting'";
                    $newStudentResult = $conn->query($newStudentQuery)->fetch_assoc();
                    echo $newStudentResult['new_students'];
                    ?>
                </p>
            </div>
            <!-- Job Posted Feature -->
            <div class="feature">
                <h2>Job Posted</h2>
                <p>
                    <?php
                    $jobQuery = "SELECT COUNT(*) as total_jobs FROM job_posting";
                    $jobResult = $conn->query($jobQuery)->fetch_assoc();
                    echo $jobResult['total_jobs'];
                    ?>
                </p>
            </div>
            <!-- Total Applications Feature -->
            <div class="feature">
                <h2>Total Applications</h2>
                <p>
                    <?php
                    $applicationQuery = "SELECT COUNT(*) as total_applications FROM application";
                    $applicationResult = $conn->query($applicationQuery)->fetch_assoc();
                    echo $applicationResult['total_applications'];
                    ?>
                </p>
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('visible');
        }
        
        function toggleProfileMenu() {
            const profileMenu = document.getElementById('profileMenu');
            profileMenu.classList.toggle('active');
        }

        // Close the profile menu if clicked outside
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
