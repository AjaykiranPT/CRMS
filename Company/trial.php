<?php
    include "connection.php";

    // Handle POST requests for job management actions (add, update, delete)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            if ($action === 'add') {
                // Add a new job post
                $job_title = $_POST['job_title'];
                $job_description = $_POST['job_description'];
                $stmt = $conn->prepare("INSERT INTO job_posting (job_title, job_description) VALUES (?, ?)");
                $stmt->bind_param("ss", $job_title, $job_description);
                $stmt->execute();
                $stmt->close();
            } elseif ($action === 'update') {
                // Update an existing job post
                $job_id = $_POST['job_id'];
                $job_title = $_POST['job_title'];
                $job_description = $_POST['job_description'];
                $stmt = $conn->prepare("UPDATE job_posting SET job_title = ?, job_description = ? WHERE job_id = ?");
                $stmt->bind_param("ssi", $job_title, $job_description, $job_id);
                $stmt->execute();
                $stmt->close();
            } elseif ($action === 'delete') {
                // Delete a job post
                $job_id = $_POST['job_id'];
                $stmt = $conn->prepare("DELETE FROM job_posting WHERE job_id = ?");
                $stmt->bind_param("i", $job_id);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Fetch all posted jobs
    $stmt = $conn->prepare("SELECT * FROM job_posting");
    $stmt->execute();
    $jobs_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Job Posts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: #1e1e1e;
            color: #ffffff;
        }
        .main-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 2rem;
        }
        .header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            background-color: #333;
        }
        .header .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2f5fff;
        }
        .container {
            width: 80%;
            margin-top: 2rem;
        }
        .job-list, .job-form {
            background-color: #2d2d2d;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .job-list h2, .job-form h2 {
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
        .job-actions form {
            display: inline-block;
        }
        .job-actions button {
            background-color: #2f5fff;
            border: none;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 5px;
        }
        .job-actions button:hover {
            background-color: #1a3a7f;
        }
        .job-form form {
            display: flex;
            flex-direction: column;
        }
        .job-form input[type="text"], .job-form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: none;
            border-radius: 5px;
        }
        .job-form button {
            width: 200px;
            padding: 10px;
            background-color: #2f5fff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .job-form button:hover {
            background-color: #1a3a7f;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="header">
            <a href="#" class="logo">Job Manager</a>
        </div>

        <div class="container">
            <!-- Post a New Job -->
            <div class="job-form">
                <h2>Post a New Job</h2>
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="text" name="job_title" placeholder="Job Title" required>
                    <textarea name="job_description" placeholder="Job Description" rows="5" required></textarea>
                    <button type="submit">Post Job</button>
                </form>
            </div>

            <!-- Display All Jobs -->
            <div class="job-list">
                <h2>All Posted Jobs</h2>
                <?php while ($job = $jobs_result->fetch_assoc()): ?>
                    <div class="job">
                        <div>
                            <span><?php echo htmlspecialchars($job['job_title']); ?></span>
                            <p><?php echo htmlspecialchars($job['job_description']); ?></p>
                        </div>
                        <div class="job-actions">
                            <!-- Edit Job Form -->
                            <form method="POST">
                                <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="text" name="job_title" value="<?php echo htmlspecialchars($job['job_title']); ?>" required>
                                <textarea name="job_description" rows="3"><?php echo htmlspecialchars($job['job_description']); ?></textarea>
                                <button type="submit">Update</button>
                            </form>
                            <!-- Delete Job Form -->
                            <form method="POST">
                                <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    // Close connection
    $conn->close();
?>
