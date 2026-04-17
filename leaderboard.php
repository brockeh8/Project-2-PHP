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

    <div class="card">
        <h1>Leaderboard</h1>
        <p class="muted">This page stays visible without requiring a new login.</p>
        <?php if (empty($entries)): ?>
            <p>No scores have been saved yet.</p>
        <?php else: ?>
            <table class="table">
                <tr><th>Rank</th><th>Username</th><th>Score</th><th>Date</th></tr>
                <?php foreach ($entries as $index => $entry): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo h($entry['username']); ?></td>
                        <td><?php echo (int) $entry['score']; ?></td>
                        <td><?php echo h($entry['date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
