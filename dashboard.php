<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="dashboard.php">Dashboard</a><a href="leaderboard.php">Leaderboard</a><a href="logout.php">Logout</a></div></div></div>
<div class="container">
    <div class="card hero">
        <h1>Welcome, <?php echo h($_SESSION['username']); ?></h1>
        <p>This is the main player dashboard. Start a new match, then choose the second registered player in the lobby.</p>
        <a class="button secondary" href="lobby.php">Go to Lobby</a>
    </div>

    <div class="grid">
        <div class="card">
            <h2>Rules</h2>
            <p>Each player answers 3 questions for a total of 6 turns. Correct answers earn points. Each player gets one pass lifeline for the whole game.</p>
        </div>
        <div class="card">
            <h2>Strong but manageable</h2>
            <p>This version is meant to feel complete without being too advanced for the class. It focuses on clear PHP logic and clean structure.</p>
        </div>
    </div>
</div>
</body>
</html>
