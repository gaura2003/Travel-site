<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page title</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .pad {
            padding: 20px;
        }       

        .header {
            background-color: #333;
            padding: 10px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
            color: #fff;
        }

        .user {
            display: flex;
            align-items: center;
        }

        .auth-buttons a {
            text-decoration: none;
            color: #fff;
            margin-right: 20px;
        }

        .auth-buttons a:last-child {
            margin-right: 0;
        }

        .contact-icons {
            display: flex;
            align-items: center;
        }

        .contact-icons i {
            margin-right: 10px;
            color: #fff;
            font-size: 28px;
            cursor: pointer;
        }
       
        .user-name {
            margin-right: 10px;
            font-size: 20px;
            font-weight: bolder;
            text-transform: uppercase;
        }
            
    </style>
</head>
<body>
<div class="header">
    <div class="navbar">
        <div class="contact-icons">
           
            <a href="admin logout.php"><i class="fas fa-arrow-alt-circle-left"></i></a>

        </div>

        <div class="user">
            <span class="user-name">
                <?php
                // Check if user is logged in
                session_start();

                if (isset($_SESSION['username'])) {
                    echo "Hi, ". $_SESSION['username'];
                }
                ?>
            </span>

            <div class="auth-buttons">
                <?php
                // Check if user is logged in
                if (!isset($_SESSION['username'])) {
                   
                    echo '<a href="admin login.php">Sign In</a>';
                } else {
                    // Add logout button here if needed
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
