<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Slider Image</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            text-align: center;
        }
        
        .form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        input[type="file"] {
            display: block;
            margin-bottom: 10px;
        }
        
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-sizing: border-box;
        }
        
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
        
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
        
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>  
      
    <?php include 'admin navbar.php'; ?>
    <?php

// Include database connection
require_once('db_connection.php');
 
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    $destination_id = $_POST['destination_id'];

    // Check if image is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_name = $_FILES['image']['name'];
        
        // Move image to destination folder
        $image_path = 'slider_images/' . $image_name;
        move_uploaded_file($image_tmp_name, $image_path);

        // Insert slider image into database
        $sql = "INSERT INTO slider_images (image_path, destination_id) VALUES ('$image_path', '$destination_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Slider image added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

    <h2>Add Slider Image</h2>
    <form class="form" action="admin_slider.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <select name="destination_id" required>
            <option value="" disabled selected>Select Destination</option>
            <!-- Fetch destinations from database and populate dropdown -->
            <?php
            $sql = "SELECT * FROM destinations";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["destination_id"] . "'>" . $row["name"] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No destinations available</option>";
            }
            ?>
        </select>
        <button type="submit">Upload Image</button>
               
    </form>
    
    <?php include  'image_slider.php'; ?>
    
    <?php
// Include database connection
require_once('db_connection.php');

// Retrieve slider images from the database
$sql = "SELECT * FROM slider_images";
$result = $conn->query($sql);
?>
        <style>
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-btn {
            
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: #c82333;
        }
    </style>
    <h2>Slider Image Data</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Image Path</th>
            <th>Destination ID</th>
            <th>Action</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['image_id']; ?></td>
                    <td><?php echo $row['image_path']; ?></td>
                    <td><?php echo $row['destination_id']; ?></td>
                    <td>
                        <form method="post" action="delete_slider_image.php" onsubmit="return confirm('Are you sure you want to delete this image?')">
                            <input type="hidden" name="delete_id" value="<?php echo $row['image_id']; ?>">
                            <button type="submit" class="delete-btn" style="background-color: #dc3545;">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No images found in the slider.</td></tr>
        <?php endif; ?>
    </table>
    
</body>
<?php include 'admin footer.php'; ?>
</html>
