<?php
session_start();

// Include database connection
include '../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Check if a new review is being submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $review = $_POST["review"];

    $stmt = $pdo->prepare("INSERT INTO reviews (name, review) VALUES (:name, :review)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':review', $review);
    $stmt->execute();

    echo "Review submitted successfully!";
}

// Retrieve and display all reviews
$stmt = $pdo->query("SELECT name, review FROM reviews");

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
                <a href="dashboard.php" target="_self">Home</a>
                <a href="profile.php">Profile</a>

            </nav>

            <a href="reservation.html" class="button">Reserve a table now</a>
            
    </header>
<br><br><br><br><br><br>
    <h1>Leave a Review</h1>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br><br>
        <label for="review">Review:</label><br>
        <textarea id="review" name="review" rows="4" cols="50" required></textarea><br><br>
        <button type="submit">Submit</button>
    </form>

    <h2>Reviews:</h2>
    <?php
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<p><strong>" . $row["name"] . "</strong>: " . $row["review"] . "</p>";
    }
    ?>
</body>
</html>
