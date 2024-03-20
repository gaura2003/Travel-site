<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../css/users.css">
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this user?");
        }

        function confirmEdit() {
            return confirm("Are you sure you want to edit this user?");
        }
    </script>
</head>
<body>
    <?php include 'admin navbar.php'; ?>
    <div class="container">
        <h2>User Registration Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once('db_connection.php');
                
                // Check if user is logged in
                session_start();
                if (isset($_SESSION['username'])) {
                    // Prepare SQL statement
                    $sql = "SELECT `username`, `name`, `email`, `phone`, `reg_date` FROM `Registration`";

                    // Execute SQL statement
                    $result = $conn->query($sql);

                    // Check if there are any rows in the result
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["email"] . "</td>";
                            echo "<td>" . $row["phone"] . "</td>";
                            echo "<td>" . $row["reg_date"] . "</td>";
                            echo "<td>";
                            echo "<a href='process files/edit_user.php?username=" . $row["username"] . "' onclick='return confirmEdit();'> Edit</a> | ";
                            echo "<a href='process files/delete_user.php?username=" . $row["username"] . "' onclick='return confirmDelete();'>Delete</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users registered yet.</td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Please log in to view user registration data.</td></tr>";
                }

                // Close connection
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <?php include 'admin footer.php'; ?>
</body>
</html>
