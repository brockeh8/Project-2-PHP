<?php
session_start();
$lastUser = $_COOKIE['mellow_last_user'] ?? 'Guest';
$lastVisit = $_COOKIE['mellow_last_visit'] ?? 'First visit';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mellow Millionaire</title>
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

<div class="container">
    <div class="nav">
        <strong>Mellow Millionaire</strong>
        <div class="nav-links">
            <a class="btn secondary" href="register.php">Register</a>
            <a class="btn" href="login.php">Login</a>
            <a class="btn alt" href="leaderboard.php">Leaderboard</a>
        </div>
    </div>

    <div class="card hero">
        <h1>Mellow Millionaire</h1>
        <p>Do you think you have the skills to be a Millionaire?</p>
        <p class="small">Last saved user: <strong><?php echo htmlspecialchars($lastUser, ENT_QUOTES, 'UTF-8'); ?></strong> · Last visit: <strong><?php echo htmlspecialchars($lastVisit, ENT_QUOTES, 'UTF-8'); ?></strong></p>
        <div class="btn-row" style="justify-content:center;">
            <a class="btn secondary" href="register.php">Create Account</a>
            <a class="btn" href="login.php">Sign In</a>
            <a class="btn alt" href="leaderboard.php">See Top Scores</a>
        </div>
    </div>

    <div class="grid" style="margin-top:18px;">
        <div class="card">
            <h2>How it works</h2>
            <ul class="list-clean">
                <li>Register at least two players.</li>
                <li>Log in as one player and choose the second player in the lobby.</li>
                <li>Take turns answering ten questions.</li>
                <li>Use the one-time 50:50 lifeline wisely.</li>
                <li>Finish the round and save scores to the leaderboard.</li>
            </ul>
        </div>
        <div class="card">
            <h2>About</h2>
            <p>Mellow Millionaire is a simple PHP quiz game designed for learning purposes. It features user registration, login, a public leaderboard, and a turn-based quiz format.</p>
    </div>
</div>
</body>
</html>
