<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both email and password are provided
    if (isset($_POST['email']) && isset($_POST['password'])) {
        
        $servername = "localhost";
        $username = "user";
        $password = "user";
        $dbname = "frontendProject";


        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Escape user inputs for security
        $email = $conn->real_escape_string($_POST['email']);

        // Query to fetch user from database
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // User found, verify password
            $row = $result->fetch_assoc();
            if (password_verify($_POST['password'], $row['password'])) {
                // Password matches, set session variables and redirect to index.html
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                header("Location: ../html/index.html"); // Redirect to index.html
                exit();
            } else {
                // Invalid password
                $error = "Invalid email or password";
            }
        } else {
            // User not found
            $error = "Invalid email or password";
        }

        $conn->close();
    } else {
        // Email or password not provided
        $error = "Email and password are required";
    }
}
?>
