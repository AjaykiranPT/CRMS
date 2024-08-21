<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Posting Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #000;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .form-container h2 {
            text-align: center;
            color: #fff;
        }

        label {
            color: #fff;
            font-weight: bold;
        }

        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
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

<div class="form-container">
    <h2>Post a Job Vacancy</h2>
    <form method="POST" action="">
        <label for="jobtitle">Job Title:</label>
        <input type="text" id="jobtitle" name="jobtitle" required>

        <label for="jobid">JobID:</label>
        <input type="text" id="jobid" name="jobid">

        <label for="companyname">Company Name:</label>
        <input type="text" id="companyname" name="companyname" required>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required>

        <label for="description">Job Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="deadline">Deadline:</label>
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