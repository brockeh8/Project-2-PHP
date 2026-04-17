<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';

if (empty($_SESSION['players']) || empty($_SESSION['game_complete'])) {
    header('Location: lobby.php');
    exit;
}

$leaderboardFile = __DIR__ . '/data/leaderboard.txt';
$scores = $_SESSION['scores'];
arsort($scores);
$winner = array_key_first($scores);
$highScore = $scores[$winner];
$_SESSION['winner'] = $winner;

if (empty($_SESSION['saved_results'])) {
    $_SESSION['session_leaderboard'] = $_SESSION['session_leaderboard'] ?? [];
    foreach ($_SESSION['scores'] as $player => $score) {
        saveLeaderboardEntry($leaderboardFile, $player, $score);
        $_SESSION['session_leaderboard'][] = [
            'username' => $player,
            'score' => $score
        ];
    }
    $_SESSION['saved_results'] = true;
}

$history = $_SESSION['scores_history'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="card center">
        <h1>Round Complete</h1>
        <p><strong><?php echo h($winner); ?></strong> wins this round with <strong><?php echo (int) $highScore; ?></strong> points.</p>
        <div class="btn-row" style="justify-content:center;">
            <a class="btn alt" href="leaderboard.php">View Leaderboard</a>
            <a class="btn secondary" href="play_again.php">Play Again</a>
            <a class="btn danger" href="logout.php">Logout</a>
        </div>
    </div>