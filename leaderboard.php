<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
$rows = array_slice(loadLeaderboard(), 0, 10);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="index.php">Home</a><?php if (!empty($_SESSION['logged_in'])): ?><a href="dashboard.php">Dashboard</a><a href="logout.php">Logout</a><?php else: ?><a href="login.php">Login</a><a href="register.php">Register</a><?php endif; ?></div></div></div>
<div class="container">
    <div class="card">
        <h1>Public Leaderboard</h1>
        <p>This page is visible even without logging in again.</p>
        <div class="table-wrap">
            <table>
                <tr>
                    <th>Rank</th>
                    <th>Username</th>
                    <th>Score</th>
                    <th>Date</th>
                </tr>
                <?php if (count($rows) === 0): ?>
                    <tr><td colspan="4">No scores yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($rows as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo h($row['username']); ?></td>
                            <td><?php echo (int)$row['score']; ?></td>
                            <td><?php echo h($row['date']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
