<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/registeration.css">
</head>
<body>
    
    <div class="container">
        <h2>Login</h2>
        <form action="admin login_process.php" method="post">
            <input type="text" name="login" placeholder="Username or Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
       
    </div>
    <?php include  'admin footer.php'; ?>
</body>
</html>
