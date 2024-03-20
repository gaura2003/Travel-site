<?php
// Include database connection
require_once('db_connection.php');

// Handle delete operation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    
    // Delete the specific image from the database
    $delete_sql = "DELETE FROM slider_images WHERE image_id = $delete_id";
    if ($conn->query($delete_sql) === TRUE) {
        echo "Image deleted successfully!";
        header("Location: admin_slider.php");
        exit();
    } else {
        echo "Error deleting image: " . $conn->error;
    }
}
?>
