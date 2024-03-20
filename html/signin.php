<?php
// Start session
session_start();

// Include database connection
require_once('db_connection.php');

if (isset($_GET['referrer'])) {
    $_SESSION['referrer'] = $_GET['referrer'];
}

// Check if the form is submitted
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
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            
            // Check if the user came from booking.php
            if(isset($_SESSION['referrer']) && strpos($_SESSION['referrer'], "booking.php") !== false) {
                // Redirect to booking page
                header("Location: " . $_SESSION['referrer']);
                exit();
            } else {
                // Redirect to home page or wherever you want
                header("Location: home.php");
                exit();
            }
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/registeration.css">
</head>
<body>
    <?php include  'navbar.php'; ?>
    <div class="container">
        <h2>Login</h2>
        <form action="signin.php" method="post">
            <input type="text" name="login" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
    <?php include  'footer.php'; ?>
</body>
</html>
