<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if (empty($_SESSION['round_scores'])) {
    header('Location: dashboard.php');
    exit;
}

$scores = $_SESSION['round_scores'];
arsort($scores);
$names = array_keys($scores);
$winner = count($names) > 1 && $scores[$names[0]] === $scores[$names[1]] ? 'Tie Game' : $names[0];

if (empty($_SESSION['result_saved'])) {
    foreach ($_SESSION['round_scores'] as $name => $score) {
        saveLeaderboardEntry($name, $score);
    }
    $_SESSION['result_saved'] = true;
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
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="dashboard.php">Dashboard</a><a href="leaderboard.php">Leaderboard</a><a href="logout.php">Logout</a></div></div></div>
<div class="container">
    <div class="card hero">
        <h1>Game Results</h1>
        <p><?php echo $winner === 'Tie Game' ? 'This round ended in a tie.' : h($winner) . ' won the round.'; ?></p>
    </div>

    <div class="grid">
        <?php foreach ($_SESSION['round_scores'] as $name => $score): ?>
            <div class="card">
                <h2><?php echo h($name); ?></h2>
                <p>Final Score: <strong><?php echo (int)$score; ?></strong></p>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="card">
        <a class="button" href="leaderboard.php">View Leaderboard</a>
        <a class="button secondary" href="lobby.php">Play Again</a>
    </div>
</div>
</body>
</html>
