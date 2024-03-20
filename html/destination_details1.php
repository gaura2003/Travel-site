<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $destination['name']; ?> Details</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        h2, h4, p {
            text-align: center;
            margin: 10px;
        }

        .main-image {
            display: block;
            margin: 0 auto; /* Center the main image */
            max-width: 350px;
            height: auto;
            border-radius: 10px;
        }

        .extra-images {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .extra-images img {
            width: 150px;
            height: 100px;
            margin: 5px;
            object-fit: cover;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease; /* Add smooth transition for zoom effect */
        }

        .extra-images img:hover {
            transform: scale(1.1); /* Zoom in effect on hover */
        }

        .booking-button {
            background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    display: block;
    margin: 20px auto;
    margin-bottom:80px;
        }

        .booking-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php';
    
    // Include database connection
require_once('db_connection.php');

// Check if destination ID is provided in the URL
if(isset($_GET['destination_id'])) {
    $destination_id = $_GET['destination_id'];

    // Retrieve destination data from the database
    $sql = "SELECT * FROM destinations WHERE destination_id = $destination_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $destination = $result->fetch_assoc();
        // Get extra images for the destination
        $extra_images_sql = "SELECT * FROM destination_images WHERE destination_id = $destination_id";
        $extra_images_result = $conn->query($extra_images_sql);
        $extra_images = [];
        if ($extra_images_result->num_rows > 0) {
            while($row = $extra_images_result->fetch_assoc()) {
                $extra_images[] = $row['image_name'];
            }
        }
    } else {
        echo "Destination not found";
        exit(); // Exit if destination not found
    }
} else {
    echo "Destination ID not provided";
    exit(); // Exit if destination ID not provided
}
 ?>
    <h2><?php echo $destination['name']; ?> Details</h2>
    <img class="main-image" src="<?php echo $destination['main_image']; ?>" alt="<?php echo $destination['name']; ?>">
    <h4>About:</h4>
    <p><?php echo $destination['about']; ?></p>
    <p>Charges: ₹<?php echo $destination['charges']; ?></p>

    <!-- Display extra images -->
    <?php if (!empty($extra_images)): ?>
    <div class="extra-images">
        <?php foreach ($extra_images as $image): ?>
            <img src="<?php echo $image; ?>" alt="Extra Image">
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <!-- Book Now button -->
    <button class="booking-button" onclick="bookNow('<?php echo $destination['name']; ?>', '<?php echo $destination['charges']; ?>')">Book Now</button>

    <script>
        function bookNow(destinationName, charges) {
            // Redirect to booking page with pre-filled details
            window.location.href = 'booking.php?destination_name=' + encodeURIComponent(destinationName) + '&charges=' + encodeURIComponent(charges);
        }
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
