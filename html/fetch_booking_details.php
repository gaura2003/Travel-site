<?php
// Include database connection
require_once('db_connection.php');

// Check if booking ID is provided via GET request
if (isset($_GET['id'])) {
    $booking_id = $_GET['id'];

    // Prepare SQL statement to retrieve booking details by ID
    $sql_select = "SELECT * FROM user_history WHERE id = $booking_id";

    // Execute SQL statement
    $result = $conn->query($sql_select);

    // Check if booking details were found
    if ($result->num_rows > 0) {
        // Fetch booking details as associative array
        $booking_details = $result->fetch_assoc();

        // Close connection
        $conn->close();

        // Output booking details HTML
        echo '<h2>Booking Details</h2>';
        echo '<div class="booking-details">';
        echo '<p><strong>User Name:</strong> ' . $booking_details['username'] . '</p>';
        echo '<p><strong>Destination:</strong> ' . $booking_details['destination_name'] . '</p>';
        echo '<p><strong>Charges:</strong> ' . $booking_details['destination_charges'] . '</p>';
        echo '<p><strong>Booking Person:</strong> ' . $booking_details['user_name'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $booking_details['user_email'] . '</p>';
        echo '<p><strong>Phone Number:</strong> ' . $booking_details['user_number'] . '</p>';
        echo '<p><strong>Location:</strong> ' . $booking_details['user_location'] . '</p>';
        echo '<p><strong>Tour Date:</strong> ' . $booking_details['user_tour_date'] . '</p>';
        echo '<p><strong>Tour Time:</strong> ' . $booking_details['user_tour_time'] . '</p>';
        echo '<p><strong>Booking Datetime:</strong> ' . $booking_details['booking_datetime'] . '</p>';
        echo '</div>';
    } else {
        // No booking found with the provided ID
        http_response_code(404);
        echo json_encode(array('message' => 'Booking not found.'));
    }
} else {
    // No booking ID provided
    http_response_code(400);
    echo json_encode(array('message' => 'Booking ID is required.'));
}
?>
