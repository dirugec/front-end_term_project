<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all fields are provided
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        /
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
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

        // Query to insert user into database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Signup successful, set session variables and redirect to index.html
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $email;
            header("Location: ../html/index.html"); // Redirect to index.html
            exit();
        } else {
            // Error in database insertion
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        // Fields not provided
        $error = "All fields are required";
    }
}
?>
