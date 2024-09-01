<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <style>
        body {
            padding: 0;
            margin: 0;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            box-sizing: border-box;
            background-color: #222;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        header {
            background-color:black;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        header .container {
            padding: 10px;
            margin:15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid rgb(47, 95, 255);
            box-shadow:rgba(47, 95, 255, 0.507) 0px 0px 20px;
            border-radius: 10px 10px;
            background-color:black;
        }

        header .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #2f5fff;
            text-decoration: none;
        }

        nav ul {
            list-style: none;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 1rem;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            background: #0059ff;
            color: #ffffff;
            border-radius: 5px;
        }

        .form-container {
            background-color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 50%;
            justify-content:center;
            display:inline-flex;
        }
        .form-container form{
            width:80%;
        }
        .form-container h2 {
            text-align: center;
            color: lightblue;
            display:block;
        }

        label {
            color: #fff;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            background-color: #1a1a1a;
            border: 1px solid #2f5fff;
            border-radius: 5px;
            color: #ffffff;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<header>
        <div class="container">
            <nav>
                <ul>
                    <li><a href="login.php">Home</a></li>
                    <li><a href="dashboard.php">Dasboard</a></li>
                    <li><a href="register.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </header>

<div class="form-container">
    <h2>Post a Job Vacancy</h2>
    <form method="POST" action="">
        <label for="jobtitle">Job title</label>
        <input type="text" id="jobtitle" name="jobtitle" required>


        <label for="description">Job Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="jobtype">Job type</label>
        <input type="text" id="jobtype" name="jobtype" required>


        <label for="qualification">qualification</label>
        <input type="text" id="qualification" name="qualification" required>

        <label for="location">Location</label>
        <input type="text" id="location" name="location" required>

        <label for="deadline">Deadline</label>
        <input type="date" id="deadline" name="deadline">

        <button type="submit" name="submitjob">Submit</button>
    </form>
</div>

<?php
include 'connection.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set parameters and execute
    $jobtitle = $_POST['jobtitle'];
    $jobid = $_POST['jobid'];
    $companyname = $_POST['companyname'];
    $location = $_POST['location'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO JOBPOSTING (JobID, CompanyName, JobTitle, JobDescrption, Location, Deadline) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $jobid, $companyname, $jobtitle, $description, $location, $deadline);
    
    if ($stmt->execute()) {
        echo "<script>alert('Job vacancy has been successfully posted!');</script>";
    } else {
        echo "<script>alert('Error for posting the job');</script>";
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
</body>
</html>