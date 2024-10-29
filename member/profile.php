<?php
session_start();

// Include database connection
include '../db.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Get user profile information from the database
$user_id = 1; 
$stmt = $pdo->query("SELECT * FROM users WHERE id = $user_id");
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if file is uploaded
    if (isset($_FILES['profile_picture'])) {
        $upload_dir = 'uploads/';
        $file_name = $_FILES['profile_picture']['name'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        move_uploaded_file($file_tmp, $upload_dir . $file_name);
        
        // Update user profile picture path in database
        $picture_path = $upload_dir . $file_name;
        $pdo->query("UPDATE users SET profile_picture = '$picture_path' WHERE id = $user_id");

        echo "Profile picture uploaded successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Page</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>

    <p>Current Profile Picture:</p>
    <?php if (!empty($user['profile_picture'])): ?>
        <img src="<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="200">
    <?php else: ?>
        <p>No profile picture uploaded.</p>
    <?php endif; ?>

    <form action="profile.php" method="post" enctype="multipart/form-data">
        <label for="profile_picture">Upload New Profile Picture:</label>
        <input type="file" name="profile_picture" id="profile_picture">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
