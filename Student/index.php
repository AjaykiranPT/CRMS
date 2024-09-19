<?php
    include "connection.php";  // Database connection file

    // Fetch the student's details (assuming student ID is 4)
    $student_id = 4;
    $stmt = $conn->prepare("SELECT course FROM student_details WHERE student_id = ?");
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $stmt->bind_result($student_course);
    $stmt->fetch();
    $stmt->close();

    // Handle application submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['job_id'])) {
        $job_id = $_POST['job_id'];

        // Fetch company_id based on job_id (assuming there's a relationship)
        $stmt = $conn->prepare("SELECT company_id FROM job_posting WHERE job_id = ?");
        $stmt->bind_param("i", $job_id);
        $stmt->execute();
        $stmt->bind_result($company_id);
        $stmt->fetch();
        $stmt->close();

        // Insert application into the `application` table
        $application_date = date('Y-m-d');
        $stmt = $conn->prepare("INSERT INTO application (student_id, company_id, job_id, application_date) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiis", $student_id, $company_id, $job_id, $application_date);
        if ($stmt->execute()) {
            echo "<script>alert('Application submitted successfully!');</script>";
        } else {
            echo "<script>alert('Failed to submit application. Please try again.');</script>";
        }
        $stmt->close();
    }

    // Fetch job postings that match the student's course
    $stmt = $conn->prepare("SELECT job_id, jobtitle, job_description FROM job_posting WHERE course = ?");
    $stmt->bind_param("s", $student_course);
    $stmt->execute();
    $job_results = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Postings for <?php echo htmlspecialchars($student_course); ?> Students</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }
        .main-container {
            width: 80%;
            margin: 0 auto;
            padding: 2rem;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
        }
        h1 {
            color: #2f5fff;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .job-list {
            list-style: none;
            padding: 0;
        }
        .job {
            background-color: #2d2d2d;
            color: #fff;
            padding: 20px;
            margin-bottom: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .job h3 {
            color: #2f5fff;
            margin-bottom: 1rem;
        }
        .job p {
            color: #ccc;
            font-size: 0.9rem;
        }
        .apply-btn {
            background-color: #2f5fff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .apply-btn:hover {
            background-color: #1a3a7f;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Job Postings for <?php echo htmlspecialchars($student_course); ?> Students</h1>

        <?php if ($job_results->num_rows > 0): ?>
            <ul class="job-list">
                <?php while ($job = $job_results->fetch_assoc()): ?>
                    <li class="job">
                        <h3><?php echo htmlspecialchars($job['jobtitle']); ?></h3>
                        <p><?php echo htmlspecialchars($job['job_description']); ?></p>

                        <!-- Apply Form -->
                        <form method="POST">
                            <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                            <button type="submit" class="apply-btn">Apply</button>
                        </form>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No job postings available for your course at the moment.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
    // Close the database connection
    $conn->close();
?>
