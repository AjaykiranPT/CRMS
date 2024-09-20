<?php
    session_start();
    
    // Check if the message is passed through the URL, otherwise show a default message
    $message = isset($_GET['message']) ? urldecode($_GET['message']) : 'Your account is currently pending approval. Please wait for further updates.';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Approval</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            text-align: center;
            padding: 50px;
        }
        .container {
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        h1 {
            color: #ff9800;
        }
        p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pending Approval</h1>
        <p><?php echo htmlspecialchars($message); ?></p>
        <p>Please check back later.</p>
    </div>
</body>
</html>
