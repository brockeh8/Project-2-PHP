<?php
require_once __DIR__ . '/includes/functions.php';
requireLogin();

if (empty($_SESSION['players']) || empty($_SESSION['questions'])) {
    header('Location: lobby.php');
    exit;
}

$players = $_SESSION['players'];
$currentPlayer = $players[$_SESSION['turn_index'] % count($players)];
$question = $_SESSION['questions'][$_SESSION['question_index']];
$feedback = $_SESSION['feedback'] ?? '';
$_SESSION['feedback'] = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = trim((string)filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW));
    $selectedAnswer = trim((string)filter_input(INPUT_POST, 'answer', FILTER_UNSAFE_RAW));

    if ($action === 'answer') {
        if ($selectedAnswer === '') {
            $_SESSION['feedback'] = 'Please select an answer before submitting.';
        } else {
            $points = 100 * $question['difficulty'];

            if ($selectedAnswer === $question['answer']) {
                $_SESSION['round_scores'][$currentPlayer] += $points;
                $_SESSION['feedback'] = $currentPlayer . ' was correct and earned ' . $points . ' points.';
            } else {
                $_SESSION['feedback'] = $currentPlayer . ' was incorrect. The correct answer was ' . $question['answer'] . '.';
            }

            $_SESSION['question_index']++;
            $_SESSION['turn_index']++;
        }
    }

    header('Location: game.php');
    exit;
}

$label = difficultyLabel($question['difficulty']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
    <div class="card">
        <h1>Question <?php echo $_SESSION['question_index'] + 1; ?> of <?php echo count($_SESSION['questions']); ?></h1>

        <?php if ($feedback !== ''): ?>
            <div class="message info"><?php echo h($feedback); ?></div>
        <?php endif; ?>

        <div class="badge">Current Player: <?php echo h($currentPlayer); ?></div>
        <div class="badge">Difficulty: <?php echo h($label); ?></div>

        <p><strong><?php echo h($question['question']); ?></strong></p>

        <form method="post" action="game.php">
            <div class="answers">
                <?php foreach ($question['options'] as $option): ?>
                    <label>
                        <input type="radio" name="answer" value="<?php echo h($option); ?>">
                        <?php echo h($option); ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <button type="submit" name="action" value="answer">Submit Answer</button>
        </form>
    </div>

    <div class="grid">
        <?php foreach ($_SESSION['round_scores'] as $name => $score): ?>
            <div class="card">
                <h2><?php echo h($name); ?></h2>
                <p>Score: <strong><?php echo (int)$score; ?></strong></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>