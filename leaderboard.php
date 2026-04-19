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
    
<div class="money-rain" aria-hidden="true">
  <span class="coin" style="--d:0s;   --x:10%; --s:0.8">🪙</span>
  <span class="coin" style="--d:1.2s; --x:25%; --s:1.0">🪙</span>
  <span class="coin" style="--d:2.5s; --x:42%; --s:0.7">🪙</span>
  <span class="coin" style="--d:0.7s; --x:60%; --s:0.9">🪙</span>
  <span class="coin" style="--d:3.1s; --x:75%; --s:0.8">🪙</span>
  <span class="coin" style="--d:1.8s; --x:88%; --s:1.05">🪙</span>
  <span class="coin" style="--d:4.0s; --x:5%;  --s:0.65">🪙</span>
  <span class="coin" style="--d:2.2s; --x:50%; --s:0.75">🪙</span>
</div>
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
