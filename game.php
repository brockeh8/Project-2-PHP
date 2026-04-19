<?php
session_start();
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/questions.php';
requireLogin();

$prizeLadder = [
    100, 200, 300, 500, 1000,
    2000, 4000, 8000, 16000, 32000,
    64000, 125000, 250000, 500000, 1000000
];

if (isset($_GET['start'])) {
    $easyQuestions = [];
    $mediumQuestions = [];
    $hardQuestions = [];

    foreach ($questions as $question) {
        if ($question['difficulty'] === 'easy') {
            $easyQuestions[] = $question;
        } elseif ($question['difficulty'] === 'medium') {
            $mediumQuestions[] = $question;
        } elseif ($question['difficulty'] === 'hard') {
            $hardQuestions[] = $question;
        }
    }

    shuffle($easyQuestions);
    shuffle($mediumQuestions);
    shuffle($hardQuestions);

    $selectedEasy = array_slice($easyQuestions, 0, 5);
    $selectedMedium = array_slice($mediumQuestions, 0, 5);
    $selectedHard = array_slice($hardQuestions, 0, 5);

    $_SESSION['game_questions'] = array_merge($selectedEasy, $selectedMedium, $selectedHard);
    $_SESSION['current_level'] = 0;
    $_SESSION['current_winnings'] = 0;
    $_SESSION['game_complete'] = false;
    $_SESSION['walked_away'] = false;
    $_SESSION['feedback'] = '';
    $_SESSION['score_saved'] = false;
    $_SESSION['lifelines'] = [
        'pass' => 1
    ];
}

if (empty($_SESSION['game_questions']) || !isset($_SESSION['current_level'])) {
    header('Location: dashboard.php');
    exit;
}

if (!empty($_SESSION['game_complete'])) {
    header('Location: results.php');
    exit;
}

$currentLevel = $_SESSION['current_level'];

if ($currentLevel >= 15) {
    $_SESSION['game_complete'] = true;
    $_SESSION['current_winnings'] = 1000000;
    header('Location: results.php');
    exit;
}

$currentQuestion = $_SESSION['game_questions'][$currentLevel];
$feedback = $_SESSION['feedback'] ?? '';
$_SESSION['feedback'] = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = trim((string)filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW));
    $answer = trim((string)filter_input(INPUT_POST, 'answer', FILTER_UNSAFE_RAW));

    if ($action === 'walk') {
        $_SESSION['walked_away'] = true;
        $_SESSION['game_complete'] = true;
        header('Location: results.php');
        exit;
    }

    if ($action === 'pass') {
        if ($_SESSION['lifelines']['pass'] > 0) {
            $_SESSION['lifelines']['pass']--;
            $_SESSION['feedback'] = 'You used your pass lifeline and skipped this question.';
            $_SESSION['current_level']++;

            if ($_SESSION['current_level'] >= 15) {
                $_SESSION['current_winnings'] = 1000000;
                $_SESSION['game_complete'] = true;
                header('Location: results.php');
                exit;
            }

            header('Location: game.php');
            exit;
        } else {
            $_SESSION['feedback'] = 'You already used your pass lifeline.';
            header('Location: game.php');
            exit;
        }
    }

    if ($action === 'answer') {
        if ($answer === '') {
            $_SESSION['feedback'] = 'Please choose an answer.';
            header('Location: game.php');
            exit;
        }

        if ($answer === $currentQuestion['answer']) {
            $_SESSION['current_winnings'] = $prizeLadder[$currentLevel];
            $_SESSION['current_level']++;

            if ($_SESSION['current_level'] >= 15) {
                $_SESSION['game_complete'] = true;
                header('Location: results.php');
                exit;
            }

            $_SESSION['feedback'] = 'Correct! Moving on to the next question.';
            header('Location: game.php');
            exit;
        } else {
            if ($currentLevel >= 9) {
                $_SESSION['current_winnings'] = 32000;
            } elseif ($currentLevel >= 4) {
                $_SESSION['current_winnings'] = 1000;
            } else {
                $_SESSION['current_winnings'] = 0;
            }

            $_SESSION['feedback'] = 'Incorrect. The correct answer was ' . $currentQuestion['answer'] . '.';
            $_SESSION['game_complete'] = true;
            header('Location: results.php');
            exit;
        }
    }
}
$displayLevel = $currentLevel + 1;
$currentPrize = $prizeLadder[$currentLevel];
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
        <h1>Question <?php echo $displayLevel; ?> of 15</h1>

        <?php if ($feedback !== ''): ?>
            <div class="message info"><?php echo h($feedback); ?></div>
        <?php endif; ?>

        <div class="badge">Player: <?php echo h($_SESSION['username']); ?></div>
        <div class="badge">Current Prize: $<?php echo number_format($currentPrize); ?></div>
        <div class="badge">Winnings So Far: $<?php echo number_format($_SESSION['current_winnings']); ?></div>
        <div class="badge">Passes Left: <?php echo (int)$_SESSION['lifelines']['pass']; ?></div>

        <p><strong><?php echo h($currentQuestion['question']); ?></strong></p>

        <form method="post" action="game.php">
            <div class="answers">
                <?php foreach ($currentQuestion['options'] as $option): ?>
                    <label>
                        <input type="radio" name="answer" value="<?php echo h($option); ?>">
                        <?php echo h($option); ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <button type="submit" name="action" value="answer">Lock In Answer</button>
            <button class="secondary" type="submit" name="action" value="pass">Use Pass</button>
            <button class="secondary" type="submit" name="action" value="walk">Walk Away</button>
        </form>
    </div>
</div>
</body>
</html>