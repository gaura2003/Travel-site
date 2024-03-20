<!DOCTYPE html>
 <?php include  'admin navbar.php'; ?> 
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>All Users Booking History</title>
<link rel="stylesheet" href="styles.css">

<style>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.booking {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    margin-bottom: 20px;
} 

.booking p {
    margin: 5px 0;
}
.icons {
    display: flex;
    justify-content: space-around;
    margin-top: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #2bff6d;
}

.success {
    background-color: green;
    color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size:20px;
    
}
.failed{
    background-color: red;
    color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size:20px;
}
.message{
    background-color: blue;
    color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size:20px;
}
.delete{
    background-color: red;
    color: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size:20px;
}
.success:hover, .failed:hover, .message:hover, .delete:hover {
    fill: #007bff;
}

</style>
</head>
<body>
  
<div class="container">
    <h2>All Users Booking History</h2>
    <table>
        <tr>
            <th>User Name</th>
            <th>Destination</th>
            <th>Charges</th>
            <th>Booking Person</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Location</th>
            <th>Tour Date</th>
            <th>Tour Time</th>
            <th>Booking Datetime</th>
            <th>Status</th>
            <th colspan="4">Actions</th>
        </tr>
        <?php
        require_once('db_connection.php');

        // Prepare SQL statement to retrieve all booking history
        $sql_select = "SELECT * FROM user_history";
        
        // Execute SQL statement
        $result = $conn->query($sql_select);

        // Check if there are any bookings
        if ($result->num_rows > 0) {
            // Output data of each booking
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['destination_name'] . "</td>";
                echo "<td>" . $row['destination_charges'] . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['user_email'] . "</td>";
                echo "<td>" . $row['user_number'] . "</td>";
                echo "<td>" . $row['user_location'] . "</td>";
                echo "<td>" . $row['user_tour_date'] . "</td>";
                echo "<td>" . $row['user_tour_time'] . "</td>";
                echo "<td>" . $row['booking_datetime'] . "</td>";
                 echo "<td>" . $row['status'] . "</td>";
                echo "<td>";
                echo "<div class='icons'>";
                echo "<button class='success' onclick='updateStatus(" . $row['id'] . ", \"success\")'>Success</button>";
                echo "</div>";
                echo "</td>";
                echo "<td>";
                echo "<div class='icons'>";
                echo "<button class='failed' onclick='updateStatus(" . $row['id'] . ", \"failed\")'>Failed</button>";
                echo "</div>";
                echo "</td>";
                echo "<td>";
                echo "<div class='icons'>";
                echo "<button class='message'>Message</button>";
                echo "</div>";
                echo "</td>";
                echo "<td>";
                echo "<div class='icons'>";
                echo "<button class='delete'>Delete</button>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
            }

        } else {
            echo "<tr><td colspan='11'>No booking history found</td></tr>";
        }

        // Close connection
        $conn->close();
        ?>
    </table>
</div>

<script>
    function updateStatus(bookingId, status) {
        // Create an XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        
        // Configure the request
        xhr.open('POST', 'update_status.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Define what happens on successful data submission
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Reload the page to reflect changes
                window.location.reload();
            } else {
                // Handle error
                console.error(xhr.statusText);
            }
        };

        // Define what happens in case of error
        xhr.onerror = function () {
            // Handle error
            console.error(xhr.statusText);
        };

        // Send the request
        xhr.send('booking_id=' + bookingId + '&status=' + status);
    }
</script>
</body>
<?php include 'admin footer.php'; ?>
</html>
