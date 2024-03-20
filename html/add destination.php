

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data to TravelSite Database</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            margin-bottom: 40px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="file"] {
            width: 100%;
            margin-top: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Add Data to TravelSite Database</h2>

    <!-- Add Category Form -->
    <form action="add_category.php" method="post">
        <h3>Add Category</h3>
        <input type="text" name="category_name" placeholder="Category Name" required>
        <input type="submit" value="Add Category">
    </form>

    <!-- Add Destination Form -->
    <form action="add_destination.php" method="post" enctype="multipart/form-data">
        <h3>Add Destination</h3>
        <input type="text" name="name" placeholder="Destination Name" required>
        <textarea name="about" placeholder="About Destination" rows="4" required></textarea>
        <input type="text" name="charges" placeholder="Charges" required>
        <input type="file" name="main_image" accept="image/*" required>
        <select name="category_id" required>
            <option value="" disabled selected>Select Category</option>
            <!-- PHP code to fetch categories from database and generate options -->
            <?php
            require_once('db_connection.php');

            $sql = "SELECT * FROM categories";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["category_id"] . "'>" . $row["category_name"] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No categories available</option>";
            }

           
            ?>
        </select>
        <input type="submit" value="Add Destination">
    </form>

    
<?php
// Include database connection
require_once('db_connection.php');

// Fetch destination IDs and names from the database
$sql = "SELECT destination_id, name FROM destinations";
$result = $conn->query($sql);
?>
    <!-- Add Extra Images for Destination Form -->
    <form action="add_extra_images.php" method="post" enctype="multipart/form-data">
        <h3>Add Extra Images for Destination</h3>
        <select name="destination_id" required>
            <option value="" disabled selected>Select Destination</option>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <option value="<?php echo $row['destination_id']; ?>"><?php echo $row['destination_id'] . ' - ' . $row['name']; ?></option>
                <?php endwhile; ?>
            <?php else: ?>
                <option value="" disabled>No destinations available</option>
            <?php endif; ?>
        </select>
        <input type="file" name="extra_images[]" accept="image/*" multiple required>
        <input type="submit" value="Upload Extra Images">
    </form>
</div>
</body>
<?php include 'admin footer.php'; ?>
</html>
