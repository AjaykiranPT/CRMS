<?php
    include "connection.php";

    // Handle POST requests for job management actions (update, delete)
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
            if ($action === 'update') {
                // Update an existing job post
                $job_id = $_POST['job_id'];
                $job_title = $_POST['jobtitle'];
                $job_description = $_POST['job_description'];
                $stmt = $conn->prepare("UPDATE job_posting SET jobtitle = ?, job_description = ? WHERE job_id = ?");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
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
        .job-list {
            background-color: #2d2d2d;
            border-radius: 10px;
            padding: 20px;
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
        align-items: center;
    }

    .job-actions form {
        display: flex;
        flex-direction: column;
        align-items: start;
        background-color: #454545;
        padding: 10px;
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
    <div class="main-container">
        <div class="header">
            <a href="#" class="logo">Job Manager</a>
        </div>

        <div class="container">
            <!-- Redirect to Post Vacancy Page -->
            <a href="post_vacancy.php" class="post-vacancy-btn">Post a New Vacancy</a>

            <!-- Display All Jobs -->
            <div class="job-list">
                <h2>All Posted Jobs</h2>
                <?php while ($job = $jobs_result->fetch_assoc()): ?>
                    <div class="job">
                        <div>
                            <span><?php echo htmlspecialchars($job['jobtitle']); ?></span>
                            <p><?php echo htmlspecialchars($job['job_description']); ?></p>
                        </div>
                        <div class="job-actions">
                            <!-- Edit Job Form -->
                            <form method="POST">
                                <input type="hidden" name="job_id" value="<?php echo htmlspecialchars($job['job_id']); ?>">
                                <input type="hidden" name="action" value="update">
                                <input type="text" name="jobtitle" value="<?php echo htmlspecialchars($job['jobtitle']); ?>" required>
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
