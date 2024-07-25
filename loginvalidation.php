<html>
    <body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {
    // Get the user input
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Include the database connection file
    include 'connection.php';

    // Ensure the connection is still valid
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the SQL statement
    $stmt ="SELECT password FROM admin WHERE username = $input_username";
        // Verify the password
        if ($input_password == $stmt) {
            echo "Login successful!";
        } 
        else {
            echo "Invalid username or password.";
        }
    }
?>

    </body>
</html>