<?php
    session_start();
    include "connection.php";
    if (!isset($_SESSION['admin_id'])) {
        // Redirect to login page if not logged in
        header("Location: ../login.php");
        exit(); // Stop further script execution
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $company_id = $_POST['company_id'];
        $action = $_POST['action'];
    
        if ($action === 'approve') {
            $stmt = $conn->prepare("UPDATE company_details SET approval = 'approved' WHERE Company_id = ?");
            $stmt->bind_param("i", $company_id);
        } elseif ($action === 'reject') {
            $stmt = $conn->prepare("UPDATE company_details SET approval = 'rejected' WHERE Company_id = ?");
            $stmt->bind_param("i", $company_id);
        } elseif ($action === 'remove_approval') {
            $stmt = $conn->prepare("UPDATE company_details SET approval = 'pending' WHERE Company_id = ?");
            $stmt->bind_param("i", $company_id);
        }
    
        $stmt->execute();
        $stmt->close();
    }
    
    // Fetch company data
    $approved_companies_stmt = $conn->prepare("SELECT * FROM company_details WHERE approval = 'approved'");
    $approved_companies_stmt->execute();
    $approved_companies_result = $approved_companies_stmt->get_result();
    
    $rejected_companies_stmt = $conn->prepare("SELECT * FROM company_details WHERE approval = 'rejected'");
    $rejected_companies_stmt->execute();
    $rejected_companies_result = $rejected_companies_stmt->get_result();
    
    $waiting_companies_stmt = $conn->prepare("SELECT * FROM company_details WHERE approval = 'pending'");
    $waiting_companies_stmt->execute();
    $waiting_companies_result = $waiting_companies_stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managing Company</title>
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
.company-list {
    background-color: #1e1e1e;
    border-radius: 10px;
    padding: 20px;
    margin: 10px;
    border: 1px solid #333;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.company-list h2 {
    color: #2f5fff;
    margin-bottom: 15px;
}

/* Individual company item styling */
.company {
    background-color: #2d2d2d;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.company span {
    font-size: 1.1em;
    color: #ffffff;
}

.company-actions form {
    display: inline;
}

.company-actions button {
    background-color: #2f5fff;
    border: none;
    color: #ffffff;
    padding: 5px 10px;
    margin-left: 5px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.company-actions button:hover {
    background-color: #1a3a7f;
}

/* Specific styling for rejected companies */
.company-actions span {
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
        <div class="close">
            <i class="fa-solid fa-xmark" onclick="toggleSidebar()"></i>
        </div>
        <div class="bar">
            <a href="dashboard.php" >Dashboard</a>
        </div>
        <div class="bar current">
            <a href="manageCompany.php">Manage Company</a>
        </div>
        <div class="bar">
            <a href="manageStudent.php">Manage Student</a>
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
                    <a href="#">Profile</a>
                    <a href="../logout.php">Logout</a>
                </div>
            </div>
        </div>


        <div class="container">
            <!-- Approved Companies -->
            <div class="company-list">
                <h2>Approved Companies</h2>
                <?php while ($company = $approved_companies_result->fetch_assoc()): ?>
                    <div class="company">
                        <span><?php echo htmlspecialchars($company['Company_name']); ?></span>
                        <div class="company-actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="company_id" value="<?php echo htmlspecialchars($company['Company_id']); ?>">
                                <input type="hidden" name="action" value="remove_approval">
                                <button type="submit">Remove Approval</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Waiting Companies -->
            <div class="company-list">
                <h2>Waiting Companies</h2>
                <?php while ($company = $waiting_companies_result->fetch_assoc()): ?>
                    <div class="company">
                        <span><?php echo htmlspecialchars($company['Company_name']); ?></span>
                        <div class="company-actions">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="company_id" value="<?php echo htmlspecialchars($company['Company_id']); ?>">
                                <input type="hidden" name="action" value="approve">
                                <button type="submit">Approve</button>
                            </form>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="company_id" value="<?php echo htmlspecialchars($company['Company_id']); ?>">
                                <input type="hidden" name="action" value="reject">
                                <button type="submit">Reject</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <!-- Rejected Companies -->
            <div class="company-list">
                <h2>Rejected Companies</h2>
                <?php while ($company = $rejected_companies_result->fetch_assoc()): ?>
                    <div class="company">
                        <span><?php echo htmlspecialchars($company['Company_name']); ?></span>
                        <div class="company-actions">
                            <span>Rejected</span>
                        </div>
                    </div>
                <?php endwhile; ?>
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
