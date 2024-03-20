<?php
// Include database connection
require_once('db_connection.php');

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $name = $_POST['name'];
    $about = $_POST['about'];
    $charges = $_POST['charges'];
    $category_id = $_POST['category_id'];
    
    // Check if main image is uploaded
    if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] === UPLOAD_ERR_OK) {
        $main_image_tmp_name = $_FILES['main_image']['tmp_name'];
        $main_image_name = $_FILES['main_image']['name'];
        
        // Generate unique filename to prevent overwriting
        $main_image_path = 'destination_images/' . uniqid() . '_' . $main_image_name;
        
        // Move main image to destination folder
        if (move_uploaded_file($main_image_tmp_name, $main_image_path)) {
            // Insert destination into database
            $sql = "INSERT INTO destinations (category_id, name, about, charges, main_image) VALUES ('$category_id', '$name', '$about', '$charges', '$main_image_path')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Destination added successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        // If main image not uploaded, set path to null
        $main_image_path = 'destination_images/';
        
        // Insert destination into database without image
        $sql = "INSERT INTO destinations (category_id, name, about, charges, main_image) VALUES ('$category_id', '$name', '$about', '$charges', '$main_image_path')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Destination added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
    // Close connection
    $conn->close();
} else {
    // Redirect back to form if accessed directly
    header("Location: add destination.php");
    exit();
}
?>
