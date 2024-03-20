<?php
session_start();

// Initialize variables to store user details
$username = "";
$name = "";
$email = "";
$phone = "";

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Retrieve user details from session
    $username = $_SESSION['username'];

    // Assuming you have a database connection established
    require_once('db_connection.php');

    // Prepare SQL statement to fetch user details
    $sql = "SELECT * FROM Registration WHERE username = ?";
    
    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Assign user details to variables
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];
    } else {
        // Handle case where user details are not found in the database
        // You can display an error message or take other appropriate actions
    }

    
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
require_once('db_connection.php');

session_start();

// Retrieve form data
$destination = $_POST['destination'];
$charges = $_POST['charges'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$location = $_POST['location'];
$tour_date = $_POST['tour-date'];
$tour_time = $_POST['tour-time'];

// Add current date and time
$current_datetime = date('Y-m-d H:i:s');

// Check if user is logged in
if (isset($_SESSION['username'])) {
    // Get username from session
    $username = $_SESSION['username'];

    // Prepare SQL statement to insert booking details into the user_history table
    
$sql_insert = "INSERT INTO user_history (username, destination_name, destination_charges, user_name, user_email, user_number, user_location, user_tour_date, user_tour_time, booking_datetime, status) VALUES ('$username', '$destination', '$charges', '$name', '$email', '$number', '$location', '$tour_date', '$tour_time', '$current_datetime', 'pending')";


    if ($conn->query($sql_insert) === TRUE) {
        echo '<div class="popup-container" id="popup">
        <div class="popup-content">
            <img src="XD4x.gif" alt="Success Image" class="popup-img">
            <p>Booking successful!</p>
            <button onclick="redirectToHistory()">OK</button>
        </div>
    </div>';
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
} else {
    session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signin.php"); // Redirect to sign-in page if not logged in
    exit();
}

}

// Close connection
$conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            color: #fff;
        }

        .contact-icons {
            display: flex;
            align-items: center;
        }

        .contact-icons i {
            margin-right: 10px;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
        }
       
        .user-name {
            margin-right: 10px;
            font-size: 20px;
            font-weight: bolder;
            text-transform: uppercase;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="date"],
        input[type="time"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            margin: 20px auto;
            margin-bottom:60px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        /* Style for the pop-up */
        .popup-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }

        .popup-img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            margin-bottom: 20px;
        }
        
        button{
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="navbar">
            <div class="contact-icons">
                <a href="https://wa.me/+917440305830"><i class="fab fa-whatsapp"></i></a>
                <a href="tel:7440305830"><i class="fas fa-phone"></i></a>
            </div>

            <div class="user">
                <span class="user-name">
                    <?php
                    // Check if user is logged in
                    if (isset($_SESSION['username'])) {
                        echo "Hi, ". $_SESSION['username'];
                    }
                    ?>
                </span>

                <div class="auth-buttons">
                    <?php
                    // Check if user is logged in
                    if (!isset($_SESSION['username'])) {
                        $current_url = urlencode($_SERVER['REQUEST_URI']);
                        echo '<a href="signup.php?referrer=' . $current_url . '">Sign Up</a>';
                        echo '<a href="signin.php?referrer=' . $current_url . '">Sign In</a>';
                    } else {
                        // Add logout button here if needed
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Booking Details</h2>
        <form action="booking.php" method="post"> <!-- Removed the action attribute for now -->
            <!-- Destination and Charges -->
            <div class="form-group">
                <label for="destination">Destination:</label>
                <input type="text" id="destination" name="destination" value="<?php echo isset($_GET['destination_name']) ? htmlspecialchars($_GET['destination_name']) : ''; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="charges">Charges:</label>
                <input type="text" id="charges" name="charges" value="<?php echo isset($_GET['charges']) ? htmlspecialchars($_GET['charges']) : ''; ?>" readonly>
            </div>

            <!-- Autofilled fields -->
            <!-- Name -->
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <!-- Email -->
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <!-- Phone -->
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>

            <!-- Remaining fields -->
            <!-- Location -->
            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
            </div>
            <!-- Tour Date -->
            <div class="form-group">
                <label for="tour-date">Tour Date:</label>
                <input type="date" id="tour-date" name="tour-date" required>
            </div>
            <!-- Tour Time -->
            <div class="form-group">
                <label for="tour-time">Tour Time:</label>
                <input type="time" id="tour-time" name="tour-time" required>
            </div>
            <!-- Hidden field for current datetime -->
            <input type="hidden" name="current_datetime" value="<?php echo date('Y-m-d H:i:s'); ?>">

            <!-- Submit Button -->
            <button type="submit">Submit Booking</button>
        </form>
    </div>

    <?php include 'footer.php'; ?>
</body>
<script>
        // Function to redirect to history.php
        function redirectToHistory() {
            window.location.href = 'user history.php';
        }

        // Display the pop-up
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('popup').style.display = 'block';
        });
    </script>
</html>
