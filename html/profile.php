<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spotify Profile Clone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            flex-wrap: wrap;
        }

        .box {
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            flex: 1 1 30%; /* Adjust as needed */
            text-align: center;
        }

        .profile {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            flex: 1 1 100%; /* Adjust as needed */
            text-align: center;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            margin-top: 20px;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            text-align: left;
        }

        .profile-info p {
            margin: 0;
            font-size: 16px;
        }

        .logout-btn {
            margin-top: 20px;
            text-align: center;
        }

        .logout-btn button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom:100px;
        }

        .logout-btn button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: signin.php"); // Redirect to sign-in page if not logged in
    exit();
}

// Get user information from the session or database
$username = $_SESSION['username'];
// You can fetch additional user information from the database based on the username

// Include header file
include 'navbar.php';
?>

<div class="container">
    <div class="profile">
        <div class="profile-avatar">
            <img src="https://via.placeholder.com/150" alt="Profile Picture">
        </div>
        <div class="profile-info">
            <p>Name: <?php echo $username; ?></p>
            <p>Email: <?php echo $_SESSION['email']; ?></p>
            <div class="edit-profile-icon" id="edit-profile-icon">
                <i class="fas fa-pencil-alt"></i> Edit Profile
            </div>
        </div>
    </div>
    
    <div class="box"><h5>Saved Destinations</h5></div>
    <div class="box"><h5>Booking<br> History</h5></div>
    <div class="box"><h5>Payment Methods</h5></div>
    <div class="box"><h5>Terms and conditions</h5></div>

    
</div>

<div class="logout-btn">
    <form action="logout.php" method="post">
        <button type="submit">Logout</button>
    </form>
</div>

<!-- Include footer -->
<?php include 'footer.php'; ?>

<!-- Script to toggle visibility of profile details on clicking the edit profile icon -->
<script>
    document.getElementById('edit-profile-icon').addEventListener('click', function() {
        var profileDetails = document.getElementById('profile-details');
        if (profileDetails.style.display === 'none') {
            profileDetails.style.display = 'block';
        } else {
            profileDetails.style.display = 'none';
        }
    });
</script>

</body>
</html>
