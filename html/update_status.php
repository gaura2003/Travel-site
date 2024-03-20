<?php
// Include the database connection file
require_once('db_connection.php');

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the parameters are set and not empty
    if (isset($_POST['booking_id']) && isset($_POST['status']) && !empty($_POST['booking_id']) && !empty($_POST['status'])) {
        // Sanitize the input to prevent SQL injection
        $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
        // Prepare and execute the SQL query to update the status
        $sql_update = "UPDATE user_history SET status = '$status' WHERE id = '$booking_id'";
        if ($conn->query($sql_update) === TRUE) {
            // Success message
            echo "Status updated successfully";
        } else {
            // Error message
            echo "Error updating status: " . $conn->error;
        }
    } else {
        // Error message if parameters are not set or empty
        echo "Error: Missing parameters";
    }
} else {
    // Error message if request method is not POST
    echo "Error: Invalid request method";
}

// Close the database connection
$conn->close();
?>
