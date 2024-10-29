<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/png" href="images\TitleLogo.png"/>
    <title>CAGAMAS COFFEE</title>
</head>
<body>
    <header class="header">
        <div id="menu" class="func-bars"></div>
        
            <a href="index.html" class="logo" style="text-decoration: none;">CAGAMAS COFFEE<i class='bx bx-coffee'></i></a>

            <nav class="navigation-bar">
                <a href="index.html" target="_self">Home</a>
                <a href="profile.php">Profile</a>
                <a href="review.php">Review</a>

            </nav>

            <a href="reservation.html" class="button">Reserve a table now</a>
            <a href="login.html" class="button">Member Login</a>
    </header>

    <section id="home" class="home">
        <div class="row">
            <div class="content">
                <h2>BUY A COFFEE</h2>
                <a href="menu.html" class="button">Wanna buy one?</a>
            </div>

            <div class="image">
                <span></span>
                <span></span>
                <img src="images/home-img-1.png" class="main-home-image" alt="">
            </div>
        </div>
    </section>

    
    
</body>
</html>