<?php
session_start();
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
<div class="money-rain" aria-hidden="true">
  <span class="coin" style="--d:0s; --x:10%; --s:0.8">🪙</span>
  <span class="coin" style="--d:1.2s; --x:25%; --s:1.0">🪙</span>
  <span class="coin" style="--d:2.5s; --x:42%; --s:0.7">🪙</span>
  <span class="coin" style="--d:0.7s; --x:60%; --s:0.9">🪙</span>
  <span class="coin" style="--d:3.1s; --x:75%; --s:0.8">🪙</span>
  <span class="coin" style="--d:1.8s; --x:88%; --s:1.05">🪙</span>
</div>

<div class="nav">
    <div class="nav-inner">
        <div class="brand">Mellow Millionaire</div>
        <div class="nav-links">
            <a href="leaderboard.php">Leaderboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card hero">
        <h1>Welcome, <?php echo h($_SESSION['username']); ?>!</h1>
        <p>Answer 15 questions, use your lifeline wisely, and decide whether to keep going or walk away with your winnings.</p>
        <a class="btn" href="game.php?start=1">Start the Game</a>
    </div>
</div>
</body>
</html>