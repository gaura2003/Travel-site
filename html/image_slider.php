<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Slider</title>
    <style>
     
   /* Style for the image slider */
        .slider-container {
            position: relative;
            width: 100%;
            max-width: 600px; /* Adjust maximum width as needed */
            height: 120px; /* Adjust height as needed */
            overflow: hidden;
            margin: 0 auto; /* Center the slider */
           
        }

        .slider-item {
            position: absolute;
            top: 0;
            left: 100%; /* Initially position items outside the container */
            width: 100%;
            height: 100%;
            transition: left 5s ease; /* Add transition for sliding effect */
        }

        .slider-item.active {
            left: 0; /* Slide the active item into view */
        }

        .slider-item img {
            width: 90%;
            height: 100%;
            object-fit: cover; /* Ensure images cover the entire slider */
            cursor: pointer; 
            margin-bottom: 20px;
            margin:0 20px;
            border-radius: 20px; /* Change cursor to pointer on hover */
        }
    </style>
</head>
<body>
    <div class="slider-container">
        <?php
            // Include database connection
            require_once('db_connection.php');

            // Retrieve slider images from the database
            $sql = "SELECT * FROM slider_images";
            $result = $conn->query($sql);
        ?>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="slider-item" onclick="openDestinationDetails(<?php echo $row['destination_id']; ?>)">
                    <img src="<?php echo $row['image_path']; ?>" alt="Slider Image">
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images found in the slider.</p>
        <?php endif; ?>
    </div>

    <!-- Script to handle slider functionality -->
    <script>
        var slideIndex = 0;
        var slides = document.querySelectorAll(".slider-item");

        function showSlides() {
            slides.forEach(slide => slide.classList.remove("active"));
            slideIndex++;
            if (slideIndex > slides.length - 1) {slideIndex = 0;}
            slides[slideIndex].classList.add("active");
            setTimeout(showSlides, 7000); // Slide every 7 seconds (5 seconds animation + 2 seconds pause)
        }
        showSlides();
        
        function openDestinationDetails(destinationId) {
            // Redirect to destination details page with the specific destination ID
            window.location.href = 'destination_details1.php?destination_id=' + destinationId;
        }
    </script>
</body>
</html>
