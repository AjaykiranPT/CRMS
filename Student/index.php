<?php
    include "connection.php";  // Database connection file

    // Fetch the student's details (assuming student ID is 4)
    if (!isset($_SESSION['student_id'])) {
        // Redirect to login page if not logged in
        header("Location: ../login.php");
        exit(); // Stop further script execution
    }
    
    $company_id=$_SESSION['student_id'];

    $stmt = $conn->prepare("SELECT course FROM student_details WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $stmt->bind_result($student_course);
    $stmt->fetch();
    $stmt->close();

    // Handle application actions (apply or remove)
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id']) && isset($_POST['action'])) {
        $job_id = $_POST['job_id'];
        $action = $_POST['action'];

        if ($action === 'apply') {
            // Apply for the job
            $stmt = $conn->prepare("SELECT company_id FROM job_posting WHERE job_id = ?");
            $stmt->bind_param("i", $job_id);
            $stmt->execute();
            $stmt->bind_result($company_id);
            $stmt->fetch();
            $stmt->close();

            // Insert application into the application table
            $application_date = date('Y-m-d');
            $stmt = $conn->prepare("INSERT INTO application (student_id, company_id, job_id, application_date) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiis", $student_id, $company_id, $job_id, $application_date);
            if ($stmt->execute()) {
                echo "<script>alert('Application submitted successfully!');</script>";
            } else {
                echo "<script>alert('Failed to submit application. Please try again.');</script>";
            }
            $stmt->close();
        } elseif ($action === 'remove') {
            // Remove the application
            $stmt = $conn->prepare("DELETE FROM application WHERE student_id = ? AND job_id = ?");
            $stmt->bind_param("ii", $student_id, $job_id);
            if ($stmt->execute()) {
                echo "<script>alert('Application removed successfully!');</script>";
            } else {
                echo "<script>alert('Failed to remove application. Please try again.');</script>";
            }
            $stmt->close();
        }
    }

    // Fetch job postings that match the student's course
    $stmt = $conn->prepare("
    SELECT 
        jp.job_id, 
        jp.jobtitle, 
        jp.job_description, 
        jp.deadline, 
        jp.course, 
        jp.job_location, 
        jp.jobtype, 
        c.company_name 
    FROM job_posting jp
    JOIN company_details c ON jp.company_id = c.company_id
    WHERE jp.course = ? AND jp.deadline >= CURDATE()
");
    $stmt->bind_param("s", $student_course);
    $stmt->execute();
    $jobs_result = $stmt->get_result();

    // Fetch jobs the student has already applied for
    $stmt = $conn->prepare("SELECT job_id FROM application WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $applied_jobs_result = $stmt->get_result();
    $applied_jobs = [];
    while ($row = $applied_jobs_result->fetch_assoc()) {
        $applied_jobs[] = $row['job_id'];
    }
    $stmt->close();
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

        
        .job-list {
            background-color: #2d2d2d;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .job-list h2 {
            color: #2f5fff;
            margin-bottom: 1rem;
        }
        .job {
            background-color: #3d3d3d;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .job span {
            color: #fff;
        }
        .job-actions {
        display: flex;
        gap: 10px;
        width: 20%;
        align-items: center;
    }

    .job-actions form {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #454545;
        padding: 10px;
        width: 50%;
        border-radius: 5px;
    }

    .job-actions input[type="text"],
    .job-actions textarea {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        border: 1px solid #555;
        border-radius: 5px;
        background-color: #2d2d2d;
        color: #fff;
    }

    .job-actions input[type="text"]:focus,
    .job-actions textarea:focus {
        border-color: #2f5fff;
        outline: none;
    }

    .job-actions button {
        background-color: #2f5fff;
        border: none;
        color: white;
        padding: 8px 12px;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 5px;
        transition: background-color 0.3s ease;
    }

    .job-actions button:hover {
        background-color: #1a3a7f;
    }

        .post-vacancy-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2f5fff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            cursor: pointer;
        }
        .post-vacancy-btn:hover {
            background-color: #1a3a7f;
        }
    </style>

</head>
<body>

<div class="sidebar" id="sidebar">
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar current">
            <a href="index.php">Home</a>
        </div>
        <div class="bar">
            <a href="dashboard.php">Dashboard</a>
        </div>
        <div class="bar">
            <a href="appliedjobs.php">Applied Jobs</a>
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
                    <a href="#">Profile</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
    </div>

    <div class="container">
        <div class="job-list">
            <h2>All Posted Jobs</h2>
            <?php while ($job = $jobs_result->fetch_assoc()): ?>
            <div class="job">
                <h2><?php echo htmlspecialchars($job['jobtitle']); ?></h2>
                <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name']); ?></p>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($job['job_location']); ?></p>
                <p><strong>Job Type:</strong> <?php echo htmlspecialchars($job['jobtype']); ?></p>
                <p><strong>Eligibility:</strong> <?php echo htmlspecialchars($job['course']); ?></p>
                <p><strong>Deadline:</strong> <?php echo htmlspecialchars($job['deadline']); ?></p>
                <p><?php echo htmlspecialchars($job['job_description']); ?></p>
                
                <div class="job-actions">
    
                    <?php if (in_array($job['job_id'], $applied_jobs)): ?>
        
                        <button disabled>Applied</button>
                    <?php else: ?>
        
                        <form method="POST">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <input type="hidden" name="action" value="apply">
                            <button type="submit">Apply</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
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