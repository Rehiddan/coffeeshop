<?php
session_start();
require '../db.php';

// Get form inputs
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare and execute query
$query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$query->bindParam(':username', $username);
$query->execute();

$user = $query->fetch(PDO::FETCH_ASSOC);

if ($user && $password == $user['password']) {
    // Store user session data
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    header("Location: ../member/dashboard.php");
    exit();
} else {
    echo "Invalid username or password.";
}
?>
