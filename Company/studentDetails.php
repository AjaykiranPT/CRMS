<?php
    session_start();
    include "connection.php";

    // Check if company is logged in, otherwise redirect
    if (!isset($_SESSION['company_id'])) {
        header("Location: ../login.php");
        exit();
    }

    // Check if both student_id and application_id are set
    if (!isset($_GET['student_id']) || !isset($_GET['application_id'])) {
        echo "Invalid request.";
        exit();
    }

    $student_id = $_GET['student_id'];
    $application_id = $_GET['application_id'];

    // Fetch student details
    $stmt = $conn->prepare("SELECT * FROM student_details WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $student = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$student) {
        echo "Student not found.";
        exit();
    }

    // Fetch application status
    $stmt = $conn->prepare("SELECT application_status FROM application WHERE application_id = ?");
    $stmt->bind_param("i", $application_id);
    $stmt->execute();
    $application = $stmt->get_result()->fetch_assoc();
    $stmt->close();

    if (!$application) {
        echo "Application not found.";
        exit();
    }

    // Handle approval/rejection
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $action = $_POST['action'];

        if ($action === 'approve') {
            $stmt = $conn->prepare("UPDATE application SET application_status = 'approved' WHERE application_id = ?");
        } elseif ($action === 'reject') {
            $stmt = $conn->prepare("UPDATE application SET application_status = 'rejected' WHERE application_id = ?");
        }

        $stmt->bind_param("i", $application_id);
        $stmt->execute();
        $stmt->close();

        // Refresh application status
        header("Location: " . $_SERVER['PHP_SELF'] . "?student_id=$student_id&application_id=$application_id");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
        }

        .main-container {
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: #121212;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #fff;
        }

        .logo {
            font-size: 1.8rem;
            color: #2f5fff;
        }

        .menu-btn {
            background: none;
            border: none;
            color: #fff;
            font-size: 2rem;
        }

        .profile-container {
            position: relative;
        }

        .profile-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 100%;
            background-color: #0d0d0d;
            border: 1px solid rgb(47, 95, 255);
            padding: 10px;
            width: 150px;
            border-radius: 5px;
            z-index: 10;
        }

        .profile-menu a {
            color: rgb(47, 95, 255);
            text-decoration: none;
            padding: 10px;
            display: block;
            transition: background-color 0.3s;
        }

        .profile-menu a:hover {
            background-color: rgba(47, 95, 255, 0.1);
        }

        .profile-menu.active {
            display: block;
        }

        .container {
            padding: 50px;
            background-color: #121212;
            margin: 20px auto;
            width: 80%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            border-radius: 8px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .details p {
            font-size: 18px;
            margin: 10px 0;
        }

        .actions {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        button {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .approved {
            background-color: #28a745;
            color: #fff;
        }

        .rejected {
            background-color: #dc3545;
            color: #fff;
        }

        .back-btn {
            color: white;
            text-decoration: none;
            background-color: #007bff; /* Blue */
            border-radius: 5px;
            margin:20px;
            padding:10px;
            margin-left: 110px;
            font-size: 16px;
            width:60px;
            text-decoration: none;
        }

        .back-btn:hover {
            text-decoration: underline;
            color: black;
        }
        #studenttable{
            width:50%;
       }
       
    


    </style>
</head>
<body>

<div class="main-container">
    <!-- Header -->
    <div class="header">
        <button class="menu-btn" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>
        <a href="#" class="logo">Campus Recruit</a>
        <div class="profile-container">
            <i class="fas fa-user" id="profile" onclick="toggleProfileMenu()"></i>
            <div class="profile-menu" id="profileMenu">
                <a href="profile.php">Profile</a>
                <a href="../logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <a href="application.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back</a>

    <!-- Student Details -->
    <div class="container">
        <h1>Student Details</h1>
        <div class="details">
        <table id="studenttable">
            <tr> <td> <p><strong>First Name:</strong>           </td><td>   <?= htmlspecialchars($student['First_name']); ?></p>            </td></tr>
            <tr> <td> <p><strong>Last Name:</strong>            </td><td>   <?= htmlspecialchars($student['Last_name']); ?></p>             </td></tr>
            <tr> <td> <p><strong>Gender:</strong>               </td><td>   <?= htmlspecialchars($student['Gender']); ?></p>                </td></tr>
            <tr> <td> <p><strong>City:</strong>                 </td><td>   <?= htmlspecialchars($student['City']); ?></p>                  </td></tr>
            <tr> <td> <p><strong>Course:</strong>               </td><td>   <?= htmlspecialchars($student['Course']); ?></p>                </td></tr>
            <tr> <td> <p><strong>College:</strong>              </td><td>   <?= htmlspecialchars($student['College']); ?></p>               </td></tr>
            <tr> <td> <p><strong>Year of Passing:</strong>      </td><td>   <?= htmlspecialchars($student['Year_of_passing']); ?></p>       </td></tr>
            <tr> <td> <p><strong>Phone Number:</strong>         </td><td>   <?= htmlspecialchars($student['PhoneNum']); ?></p>              </td></tr>
            <tr> <td> <p><strong>Email:</strong>                </td><td>   <?= htmlspecialchars($student['account_email']); ?></p>         </td></tr>
            <tr> <td> <p><strong>Application Status:</strong>   </td><td>   <?= htmlspecialchars($application['application_status']); ?></p></td></tr>
        <table>
        </div>

        <!-- Action Buttons -->
        <div class="actions">
            <?php if ($application['application_status'] !== 'approved'): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="approve">
                    <button class="approved" type="submit">Approve</button>
                </form>
            <?php endif; ?>
            
            <?php if ($application['application_status'] !== 'rejected'): ?>
                <form method="POST">
                    <input type="hidden" name="action" value="reject">
                    <button class="rejected" type="submit">Reject</button>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    function toggleProfileMenu() {
        document.getElementById('profileMenu').classList.toggle('active');
    }

    // Close profile menu if clicked outside
    window.onclick = function (event) {
        if (!event.target.matches('#profile')) {
            let dropdowns = document.getElementsByClassName("profile-menu");
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('active')) {
                    openDropdown.classList.remove('active');
                }
            }
        }
    }
</script>
</body>
</html>
