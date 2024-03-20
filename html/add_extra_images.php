<?php
// Include database connection
require_once('db_connection.php');


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $destination_id = $_POST['destination_id'];

    // Check if any image is uploaded
    if (isset($_FILES['extra_images']['tmp_name']) && !empty(array_filter($_FILES['extra_images']['tmp_name']))) {
        // Loop through each uploaded image
        $image_count = count($_FILES['extra_images']['tmp_name']);
        for ($i = 0; $i < $image_count; $i++) {
            $image_tmp_name = $_FILES['extra_images']['tmp_name'][$i];
            $image_name = $_FILES['extra_images']['name'][$i];
            $image_path = 'destination_images/' . $image_name;

            // Move image to destination folder
            move_uploaded_file($image_tmp_name, $image_path);

            // Insert image path and destination ID into database
            $sql = "INSERT INTO destination_images (image_name, destination_id) VALUES ('$image_path', '$destination_id')";
            if ($conn->query($sql) !== TRUE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        echo "Extra images added successfully!";
        header("Location: add destination.php");
    exit();
    } else {
        echo "No images uploaded.";
    }
}

$conn->close();
?>
