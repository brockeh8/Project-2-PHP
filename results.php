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