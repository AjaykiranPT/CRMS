<html>
    <body>
    <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $stmt = $conn->prepare("SELECT password FROM admin WHERE username = ?");
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param('s', $input_username);

    // Execute the statement
    $stmt->execute();

    // Bind result variables
    $stmt->bind_result($stored_password);

    // Fetch the result
    if ($stmt->fetch()) {
        // Verify the password
        if ($input_password == $stored_password) {
            echo "Login successful!";
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();
}
?>

    </body>
</html>