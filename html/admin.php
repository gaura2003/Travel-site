<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Box Layout</title>
    <style>
         
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            padding: 20px;
        }

        .box {
            width: 130px;
            height: 130px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            text-decoration: none;
            color: white;
        }
 
        /* Different background colors for each box */
        .users { background-color: #FF6347; } /* Tomato */
        .bookings { background-color: #4682B4; } /* Steel Blue */
        .destination { background-color: #32CD32; } /* Lime Green */
        .settings { background-color: #9370DB; } /* Medium Purple */
    </style>
</head>
<body>
     <?php include 'admin navbar.php'; ?>
    <div class="container">
        <a href="users.php" class="box users">Users</a>
        <a href="total_bookings.php" class="box bookings">Bookings</a>
    </div>
    <div class="container">
        <a href="add destination.php" class="box destination">Destination</a>
        <a href="admin_slider.php" class="box settings"><center>Site<br> Settings</center></a>
    </div>
     
</body>
<?php include 'admin footer.php'; ?>
</html>
