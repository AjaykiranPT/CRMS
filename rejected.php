<?php
    session_start();
    
    // Check if the message is passed through the URL, otherwise show a default message
    $message = isset($_GET['message']) ? urldecode($_GET['message']) : 'Your account has been rejected. Please contact support for further details.';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Rejected</title>
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
            color: #f44336;
        }
        p {
            font-size: 18px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Account Rejected</h1>
        <p><?php echo htmlspecialchars($message); ?></p>
        <p>If you think this is a mistake, please contact support.</p>
    </div>
</body>
</html>
