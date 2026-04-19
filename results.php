<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if (empty($_SESSION['game_complete'])) {
    header('Location: dashboard.php');
    exit;
}

$username = $_SESSION['username'];
$winnings = $_SESSION['current_winnings'] ?? 0;
$walkedAway = $_SESSION['walked_away'] ?? false;

if (empty($_SESSION['score_saved'])) {
    saveLeaderboardEntry($username, $winnings);
    $_SESSION['score_saved'] = true;
}

if ($walkedAway) {
    $message = 'You walked away with your winnings.';
} elseif ($winnings >= 1000000) {
    $message = 'Congratulations! You won one million dollars!';
} elseif ($winnings > 0) {
    $message = 'Game over. You still earned a solid amount.';
} else {
    $message = 'Game over. You left with $0 this round.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Mellow Millionaire</title>
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
            <a href="dashboard.php">Dashboard</a>
            <a href="leaderboard.php">Leaderboard</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card hero">
        <h1>Final Results</h1>
        <p><?php echo h($message); ?></p>
        <div class="score-big">$<?php echo number_format($winnings); ?></div>
        <br>
        <a class="btn" href="game.php?start=1">Play Again</a>
        <a class="btn secondary" href="leaderboard.php">View Leaderboard</a>
    </div>
</div>
</body>
</html>