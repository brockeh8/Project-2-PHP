<?php
session_start();
require_once 'includes/functions.php';

$leaderboardFile = __DIR__ . '/data/leaderboard.txt';
$entries = getTopScores(loadLeaderboard($leaderboardFile), 10);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="nav">
        <a href="index.php">Home</a>
        <div class="nav-links">
            <?php if (!empty($_SESSION['logged_in'])): ?>
                <a class="btn secondary" href="lobby.php">Lobby</a>
                <a class="btn danger" href="logout.php">Logout</a>
            <?php else: ?>
                <a class="btn secondary" href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
