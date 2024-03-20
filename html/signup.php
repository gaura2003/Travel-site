<?php
session_start();

require_once('db_connection.php');

// Store the referring URL in a session variable if the user came from booking.php
if (isset($_GET['referrer'])) {
    $_SESSION['referrer'] = $_GET['referrer'];
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security
    $reg_date = date("Y-m-d H:i:s"); // Get current date and time

    // Check if the email already exists
    $check_email_query = "SELECT * FROM Registration WHERE email = '$email'";
    $result_email = $conn->query($check_email_query);

    if ($result_email->num_rows > 0) {
        echo "Email already exists. Please use a different email address.";
    } else {
        // Check if the username already exists
        $username = strtolower(str_replace(' ', '', $name)); // Normalize username
        $check_username_query = "SELECT * FROM Registration WHERE username = '$username'";
        $result_username = $conn->query($check_username_query);

        if ($result_username->num_rows > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Prepare SQL statement
            $sql = "INSERT INTO `Registration`(`username`, `name`, `email`, `phone`, `password`, `reg_date`) 
                    VALUES ('$username', '$name', '$email', '$phone', '$password', '$reg_date')";

            // Execute SQL statement
            if ($conn->query($sql) === TRUE) {
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                // Redirect back to the referrer URL if it's set and if it's from booking.php
                if (isset($_SESSION['referrer']) && strpos($_SESSION['referrer'], "booking.php") !== false) {
                    $referrer = $_SESSION['referrer'];
                    unset($_SESSION['referrer']);
                    header("Location: $referrer");
                    exit;
                } else {
                    // If no referrer is set, redirect the user to a default page
                    header("Location: home.php"); // Change home.php to your default page
                    exit;
                }
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
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
    <title>Registration</title>
    <link rel="stylesheet" href="../css/registeration.css">
    
</head>
<body>
    <?php include  'navbar.php'; ?>
    <div class="container">
        <h2>Register</h2>
        <form action="signup.php" method="post">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="tel" name="phone" placeholder="Phone Number" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <input type="hidden" name="reg_date" value="<?php echo date('Y-m-d H:i:s'); ?>">
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="signin.php">Login here</a></p>
    </div>
    <?php include  'footer.php'; ?>
</body>
</html>
