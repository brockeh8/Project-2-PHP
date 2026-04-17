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
    
    <div class="grid" style="margin-top:18px;">
        <div class="card">
            <h2>Final Scores</h2>
            <table class="table">
                <tr><th>Player</th><th>Score</th></tr>
                <?php foreach ($scores as $player => $score): ?>
                    <tr><td><?php echo h($player); ?></td><td><?php echo (int) $score; ?></td></tr>
                <?php endforeach; ?>
            </table>
        </div>
        <div class="card">
            <h2>Round Summary</h2>
            <?php if (empty($history)): ?>
                <p>No round history available.</p>
            <?php else: ?>
                <table class="table">
                    <tr><th>Player</th><th>Correct</th><th>Difficulty</th></tr>
                    <?php foreach ($history as $item): ?>
                        <tr>
                            <td><?php echo h($item['player']); ?></td>
                            <td><?php echo $item['correct'] ? 'Yes' : 'No'; ?></td>
                            <td><?php echo (int) $item['difficulty']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>