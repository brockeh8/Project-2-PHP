<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="nav">
        <div>Logged in as <strong><?php echo h($_SESSION['username']); ?></strong></div>
        <div class="btn-row">
            <a class="btn secondary" href="leaderboard.php">Leaderboard</a>
            <a class="btn" href="logout.php">Logout</a>
        </div>
    </div>
    <div class="grid">
        <div class="card">
            <h2>Starter Dashboard</h2>
            <p>This starter version</p>
            <div class="btn-row">
                <a class="btn" href="game.php">Game Placeholder</a>
            </div>
        </div>
        <div class="card">
            <h2>What is ready</h2>
            <p>Sessions, cookies, sticky forms, password hashing, and the basic page structure are already set up for you.</p>
        </div>
    </div>
</div>
</body>
</html>
