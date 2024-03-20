<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .destination {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            margin: 10px;
            cursor: pointer; /* Add cursor pointer to indicate it's clickable */
            position: relative; /* Add position relative to position the button */
        }

        .destination img {
            width: 100%;
            max-width: 400px;
            height: auto;
            margin-bottom: 10px;
            border-radius: 10px;
        }

        .destination h2 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .destination p {
            margin: 0;
        }

        .see-details-button {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #searchInput {
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            margin-bottom:20px;
            margin: 10px;
        }
        .pad {
    padding: 20px;
}
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2>Travel Destinations</h2>
        <?php include 'image_slider.php'; 
       
// Include database connection
require_once('db_connection.php');

// Retrieve destinations from the database
$sql = "SELECT * FROM destinations";
$result = $conn->query($sql);
?>
 <!-- Add search input -->
        <input type="text" id="searchInput" placeholder="Search destinations..." oninput="searchDestinations()">
        
        <div class="destinations">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="destination" onclick="seeDetails(<?php echo $row['destination_id']; ?>)">
                        <img src="<?php echo $row['main_image']; ?>" alt="<?php echo $row['name']; ?>">
                        <h2><?php echo $row['name']; ?> - ₹<?php echo $row['charges']; ?></h2>
                        <button class="see-details-button">See Details</button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No destinations found</p>
            <?php endif; ?>
        </div>
    </div>
<div class="pad">
         
     </div>
    <script>
        function seeDetails(destinationId) {
            // Redirect to destination details page with the specific destination ID
            window.location.href = 'destination_details1.php?destination_id=' + destinationId;
        }

        function searchDestinations() {
            // Get input value and convert to lowercase for case-insensitive search
            var input = document.getElementById('searchInput').value.toLowerCase();
            var destinations = document.getElementsByClassName('destination');

            // Loop through all destinations
            for (var i = 0; i < destinations.length; i++) {
                var name = destinations[i].getElementsByTagName('h2')[0].innerText.toLowerCase();
                
                // Check if the name of the destination matches the search input
                if (name.includes(input)) {
                    destinations[i].style.display = 'block'; // Show the destination
                } else {
                    destinations[i].style.display = 'none'; // Hide the destination
                }
            }
        }
    </script>
</body>
 <?php include 'footer.php'; ?>
</html>
