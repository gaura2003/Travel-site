<?php
// Include database connection
require_once('db_connection.php');

// Check if form submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $category_name = $_POST['category_name'];
    
    // Insert category into database
    $sql = "INSERT INTO categories (category_name) VALUES ('$category_name')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Category added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    // Close connection
    $conn->close();
} else {
    // Redirect back to form if accessed directly
    header("Location: add destination.php");
    exit();
}
?>
<?php include 'admin footer.php'; ?>
