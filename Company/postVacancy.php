<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include "connection.php";

// Check session and redirect
if (!isset($_SESSION['company_id'])) {
    header("Location: ../login.php");
    exit();
}
$company_id = $_SESSION['company_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post vacancy</title>
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
            padding: 100px;
            width: 95%;
            height: calc(100vh - 60px); 
            margin: 15px;
            margin-top: 50px;
            border-radius: 10px 10px 0 0;
            background: #0d0d0d;
            text-align: center;
            display: flex;
            justify-content:center;
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
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 10;
        }

        .sidebar.visible {
            transform: translateX(0);
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

        .sidebar .bar:hover {
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
        .profile-container {
            position: relative;
            display: inline-block;
        }

        .profile-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #0d0d0d;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px;
            z-index: 1000;
            padding: 10px;
            width: 150px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        }

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

        #profile {
            font-size: 1.5em;
            color: #6b6464;
        }

        .form-container {
            background-image: linear-gradient(50deg, rgb(19, 19, 19), #000000);
            width: 60%;
            min-width: 500px;
            height: auto;
            padding: 50px;
            overflow: auto;
            border: 1px solid rgb(47, 95, 255);
            border-radius: 10px;
        }
        .form-container::-webkit-scrollbar{
            display: none;
        }
        .form-container h2 {
            text-align: center;
            color: lightblue;
        }

        .input-layer {
            margin-bottom: 45px;
            position: relative;
            width: 100%;
        }

        .input-layer label {
            position: absolute;
            top: 50%;
            left: 0;
            transform: translateY(-50%);
            color: #c0c0c0;
            font-size: 17px;
            pointer-events: none;
            font-weight: 100;
            transition: all 0.3s ease;
            letter-spacing: .5px;
        }
        .input-layer input[type='text'],
        .input-layer textarea{
            height: 30px;
            width: 100%;
            border: none;
            outline: none;
            border-bottom: 1px solid #c0c0c0;
            font-size: 16px;
            padding: 5px 0;
            background: none;
            color: #ffffff;
        }

        .input-layer input[type="text"]:focus ~ label,
        .input-layer input[type="text"]:not(:placeholder-shown) ~ label,
        .input-layer textarea:focus ~ label,
        .input-layer textarea:not(:placeholder-shown) ~ label {
            top: -20px;
            left: 0;
            color: #0059ff;
            font-size: 14px;
        }

        .input-layer input:focus,
        .input-layer textarea:focus {
            border-bottom: #0059ff 2px solid;
        }

        .input-layer input[type=submit] {
            color: rgb(47, 95, 255);
            width: 100%;
            height: 40px;
            border: 1px solid rgb(47, 95, 255);
            background-color: black;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .input-layer input[type=submit]:hover {
            color: white;
            border-color: #ffffff;
        }

        select {
            height: 40px;
            width: 100%;
            background-color: #00000054;
            outline: none;
            color: #ffffff;
            border-color: #d8d8d85b;
            border-style: inset;
            border-radius: 15px;
            font-size: 15px;
        }

        
        
        input[type="date"] {
            color: rgb(47, 95, 255);
            border: 1px solid rgb(47, 95, 255);
            font-weight: 600;
            cursor: pointer;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 20px;
            background-color: #000;
            color: #ffffff;
            width: 70%;
            box-sizing: border-box;
        }

        input[type="date"]:focus {
            border-color: #007bff;
            outline: none;
            background-color: grey;
        }
        
        @media (max-width: 768px) {
            .form-container {
                width: 90%;
            }

            .sidebar {
                width: 100%;
            }

            .sidebar.visible {
                transform: translateX(0);
            }
        }

    </style>

</head>
<body>
<div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar " >
            <a href="dashboard.php" >Dashboard</a>
        </div>
        <div class="bar ">
            <a href="application.php">Applications</a>
        </div>
        <div class="bar" >
            <a href="postedVacancy.php">Job posted</a>
        </div>
        <div class="bar current">
            <a href="postVacancy.php">Post vacancy</a>
        </div>
        <div class="bar">
            <a href="#">Profile</a>
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
        <div class="form-container">
            <h2>Post a Job Vacancy</h2>
            <form method="post" onsubmit="return company_validateForm()">
                <div class="input-layer">
                    <input type="text" id="jobtitle" name="jobtitle" placeholder=" ">
                    <label for="jobtitle">Job title</label>
                </div>
                <div class="input-layer">
                    <textarea id="description" name="description" placeholder=" "></textarea>
                    <label for="description">Job Description:</label>
                </div>
                <div class="input-layer">
                    <input type="text" id="location" name="location" placeholder=" " >
                    <label for="location">Location</label>
                </div>
                <div class="input-layer deadline">
                    <label for="deadline" class="dlabel">Deadline</label>
                    <input type="date" id="deadline" class="dinput" name="deadline">
                </div>
                <div class="input-layer">
                    <select name="course" id="course" class="course">
                        <option value="" selected disabled>Select Course</option>
                        <option value="Bachelor of Computer Applications">Bachelor of Computer Applications</option>
                        <option value="Bachelor of Commerce">Bachelor of Commerce</option>
                        <option value="Bachelor of Business Administration">Bachelor of Business Administration</option>
                        <option value="Bachelor of Social Work">Bachelor of Social Work</option>
                        <option value="B.Sc Mathematics">B.Sc Mathematics</option>
                        <option value="B.Sc Physics">B.Sc Physics</option>
                        <option value="B.Sc Chemistry">B.Sc Chemistry</option>
                        <option value="BA History">BA History</option>
                    </select>
                </div>
                <div class="input-layer">
                    <select name="jobtype" id="jobtype" class="jobtype">
                        <option value="" selected disabled>Job type</option>
                        <option value="fulltime">Full time</option>
                        <option value="parttime">Part time</option>
                    </select>
                </div>
                <div class="input-layer">
                    <input type="submit" value="Submit">
                </div>
            </form>
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
        function company_validateForm() {
        const jobTitle = document.getElementById('jobtitle').value.trim();
        const description = document.getElementById('description').value.trim();
        const location = document.getElementById('location').value.trim();
        const deadline = document.getElementById('deadline').value;
        const course = document.getElementById('course').value;
        const jobType = document.getElementById('jobtype').value;

        // Check if required fields are filled
        if (!jobTitle || !description || !location || !deadline || !course || !jobType) {
            alert("Please fill in all fields.");
            return false; // Prevent form submission
        }
        
        return true; // Allow form submission
    }
    </script>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
       // Retrieve form data
            $jobtitle = $_POST['jobtitle'];
            $description = $_POST['description'];
            $location = $_POST['location'];
            $deadline = $_POST['deadline'];
            $course = $_POST['course'];
            $jobtype = $_POST['jobtype'];

            // Prepare and bind the SQL query
            $stmt = $conn->prepare("INSERT INTO job_posting (company_id, jobtitle, job_description, job_location, Deadline, course, jobtype) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssss", $company_id, $jobtitle, $description, $location, $deadline, $course, $jobtype);

            if ($stmt->execute()) {
                header("Location: postedVacancy.php");
                exit();
            } else {
                // Print SQL error for debugging
                echo "Error: " . $stmt->error;
            }
        
            // Close statement and connection
            $stmt->close();
            $conn->close();
        }   
    ?>
</body>
</html>
