<?php
require_once('db_connection.php');

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $login = $_POST['login'];
    $password = $_POST['password'];

    // Prepare SQL statement to fetch user details
    $sql = "SELECT * FROM Registration WHERE username = ? OR email = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start a new session
            session_start();
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header("Location: admin.php"); // Redirect to home page after successful login
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "User not found. Please check your username/email and try again.";
    }
}

// Close database connection
$conn->close();
?>
