<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

$username = $_COOKIE['mellow_last_user'] ?? '';
$password = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW));
    $password = trim((string)filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW));

    if ($username === '' || $password === '') {
        $message = 'Please enter both username and password.';
    } elseif (verifyLogin($username, $password)) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        setcookie('mellow_last_user', $username, time() + (60 * 60 * 24 * 14));
        header('Location: dashboard.php');
        exit;
    } else {
        $message = 'Invalid login. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="index.php">Home</a><a href="register.php">Register</a><a href="leaderboard.php">Leaderboard</a></div></div></div>
<div class="container">
    <div class="card">
        <h1>Login</h1>
        <?php if ($message !== ''): ?>
            <div class="message error"><?php echo h($message); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo h($username); ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo h($password); ?>">

            <button type="submit">Login</button>
        </form>
    </div>
</div>
</body>
</html>
