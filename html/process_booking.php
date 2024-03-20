<?php
 include  'navbar.php'; 
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

  include  'footer.php'; 
?>
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
    <style>
        /* Your existing CSS styles */

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