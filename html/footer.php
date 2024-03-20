<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sticky Footer</title>
<link rel="stylesheet" href="../css/main.css">
<style>
    footer {
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    background-color: #333;
    color: #fff;
    padding: 10px 0;
    display: flex;
    justify-content: space-around;
}

footer .icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
}

footer .icon svg {
    fill: #fff;
    width: 24px;
    height: 24px;
    margin-bottom: 5px;
}

footer .icon span {
    font-size: 12px;
}
</style>
</head>
<body>

<!-- Your content here -->

<footer id="footer">
    <div class="icon" onclick="navigate('home')">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
</svg>
        <span>Home</span>
    </div>
    <div class="icon" onclick="navigate('search')">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
</svg>
        <span>Search</span>
    </div>
    <div class="icon" onclick="navigate('library')">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
  <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
</svg>
        <span>Bookings</span>
    </div>
    <div class="icon" onclick="navigate('profile')">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
  <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
</svg>
        <span>Profile</span>
    </div>
</footer>

</body>
<script>
  
function navigate(destination) {
    switch(destination) {
        case 'home':
            window.location.href = 'home.php';
            break;
        case 'search':
            window.location.href = 'search.php';
            break;
        case 'library':
            window.location.href = 'user history.php';
            break;
        case 'profile':
            window.location.href = 'profile.php';
            break;
        default:
            console.log("Invalid destination");
    }
}


</script>
</html>
