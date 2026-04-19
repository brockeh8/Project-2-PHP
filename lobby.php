<?php
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/questions.php';
requireLogin();

$message = '';
$otherUsers = getOtherUsers($_SESSION['username']);
$selectedOpponent = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedOpponent = trim((string)filter_input(INPUT_POST, 'opponent', FILTER_UNSAFE_RAW));

    if ($selectedOpponent === '') {
        $message = 'Please select a second player.';
    } elseif (!in_array($selectedOpponent, $otherUsers, true)) {
        $message = 'Please select a valid registered player.';
    } else {
        $questions = $questionBank;
        shuffle($questions);
        $questions = array_slice($questions, 0, 6);

        $_SESSION['players'] = [$_SESSION['username'], $selectedOpponent];
        $_SESSION['turn_index'] = 0;
        $_SESSION['question_index'] = 0;
        $_SESSION['questions'] = $questions;
        $_SESSION['round_scores'] = [$_SESSION['username'] => 0, $selectedOpponent => 0];
        $_SESSION['passes'] = [$_SESSION['username'] => 1, $selectedOpponent => 1];
        $_SESSION['game_complete'] = false;
        $_SESSION['result_saved'] = false;
        $_SESSION['feedback'] = '';

        header('Location: game.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="dashboard.php">Dashboard</a><a href="leaderboard.php">Leaderboard</a><a href="logout.php">Logout</a></div></div></div>
<div class="container">
    <div class="card">
        <h1>Game Lobby</h1>
        <p>Choose the second player for this match. The game requires at least 2 registered users.</p>

        <?php if ($message !== ''): ?>
            <div class="message error"><?php echo h($message); ?></div>
        <?php endif; ?>

        <?php if (count($otherUsers) === 0): ?>
            <div class="message info">You only have one registered user right now. Create another user account first, then come back here.</div>
        <?php else: ?>
            <form method="post" action="lobby.php">
                <label for="opponent">Second Player</label>
                <select id="opponent" name="opponent">
                    <option value="">Choose a player</option>
                    <?php foreach ($otherUsers as $name): ?>
                        <option value="<?php echo h($name); ?>" <?php echo $selectedOpponent === $name ? 'selected' : ''; ?>><?php echo h($name); ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit">Start Game</button>
            </form>
        <?php endif; ?>
    </div>
</div>
</body>
</html>