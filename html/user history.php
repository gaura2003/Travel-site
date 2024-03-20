<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Booking History</title>
<?php include 'navbar.php'; ?>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
}

.booking {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    padding: 20px;
    position: relative; /* Add position relative for positioning the triangle */
}

.booking-info {
    margin-bottom: 10px;
    display: flex;
    justify-content: space-between; /* Add this to align items */
}

.booking-info span {
    font-weight: bold;
}

.booking-status {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 20px;
    color: #fff;
    font-size: 14px;
    font-weight: bold;
}

.succes {
    background-color: #2bff6d;
}

.faile{
    background-color: #ff6363;
}

.destination {
    font-size: 18px;
    color: #333;
}

.charges {
    font-size: 16px;
    color: #666;
}

.date {
    font-size: 14px;
    color: #999;
    position: relative; /* Add position relative for positioning the triangle */
}


.popup {
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
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    max-width: 80%;
    max-height: 80%;
    overflow-y: auto;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

/* Styling for the booking details */
.booking-details {
    margin-bottom: 20px;
}

.booking-details h2 {
    color: #333;
    font-size: 20px;
    margin-bottom: 10px;
}

.booking-details p {
    color: #666;
    font-size: 16px;
    margin-bottom: 5px;
}
</style>
</head>
<body>

<div class="container">
   <?php
    require_once('db_connection.php');
    session_start();

    // Check if user is logged in
    if (isset($_SESSION['username'])) {
        // Get username from session
        $username = $_SESSION['username'];

        // Fetch booking history data for the logged-in user from the database
        $sql_select = "SELECT * FROM user_history WHERE username = '$username'";
        $result = $conn->query($sql_select);

        // Check if there are any bookings
        if ($result->num_rows > 0) {
            // Output data of each booking
            while ($row = $result->fetch_assoc()) {
                // Set status color based on status
                $status_color = $row["status"] == 'success' ? '#2bff6d' : '#ff6363';

                echo '<div class="booking">';
                echo '<div class="booking-info">';
                echo '<span class="destination">' . $row["destination_name"] . '</span>';
                echo '<span class="booking-status" style="background-color: ' . $status_color . ';">' . $row["status"] . '</span>';
                echo '</div>';
                echo '<div class="booking-info charges">₹' . $row["destination_charges"] . '</div>';
                echo '<div class="booking-info date">';
                echo '<span>Tour Date: ' . $row["user_tour_date"] . '</span>';
                // Add onclick event to trigger the popup
                echo '<div class="triangle" onclick="showPopup(' . $row["id"] . ')">See Details</div>'; 
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No booking history found for this user.</p>";
        }
    } else {
        // User is not logged in, handle the case accordingly
        echo "<p>User not logged in.</p>";
    }

    // Close connection
    $conn->close();
    ?>
    <?php include 'footer.php'; ?>
</div>

<!-- Hidden popup element -->
<div id="popup" class="popup">
    <!-- Popup content -->
    <div class="popup-content" id="popup-content">
        <!-- This will be populated with booking details via JavaScript -->
    </div>
</div>

<script>
    // Function to show popup and fetch booking details via AJAX
    function showPopup(bookingId) {
        // Fetch booking details via AJAX
        // Replace 'fetch_booking_details.php' with the actual path to your PHP script
        fetch('fetch_booking_details.php?id=' + bookingId)
            .then(response => response.text())
            .then(data => {
                // Populate popup content with fetched data
                document.getElementById('popup-content').innerHTML = data;
                // Show the popup
                document.getElementById('popup').style.display = 'block';
            })
            .catch(error => console.error('Error fetching booking details:', error));
    }

    // Close the popup when clicking outside of it
    window.onclick = function(event) {
        var popup = document.getElementById('popup');
        if (event.target == popup) {
            popup.style.display = 'none';
        }
    }
</script>

</body>

</html>
