<?php
session_start();
require_once __DIR__ . '/includes/functions.php';

$username = '';
$password = '';
$confirm = '';
$message = '';
$messageClass = 'error';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string)filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW));
    $password = trim((string)filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW));
    $confirm = trim((string)filter_input(INPUT_POST, 'confirm_password', FILTER_UNSAFE_RAW));

    if ($username === '' || $password === '' || $confirm === '') {
        $message = 'Please fill in every field.';
    } elseif (!preg_match('/^[A-Za-z0-9_]{3,20}$/', $username)) {
        $message = 'Username must be 3 to 20 characters using letters, numbers, or underscores.';
    } elseif ($password !== $confirm) {
        $message = 'Passwords do not match.';
    } elseif (strlen($password) < 4) {
        $message = 'Password must be at least 4 characters.';
    } elseif (usernameExists($username)) {
        $message = 'That username already exists.';
    } else {
        registerUser($username, $password);
        setcookie('mellow_last_user', $username, time() + (60 * 60 * 24 * 14));
        $message = 'Registration successful. You can log in now.';
        $messageClass = 'success';
        $username = '';
        $password = '';
        $confirm = '';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Mellow Millionaire</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="nav"><div class="nav-inner"><div class="brand">Mellow Millionaire</div><div class="nav-links"><a href="index.php">Home</a><a href="login.php">Login</a><a href="leaderboard.php">Leaderboard</a></div></div></div>
<div class="container">
    <div class="card">
        <h1>Register</h1>
        <p>Create a new account so your username can be tied to scores and leaderboard entries.</p>
        <?php if ($message !== ''): ?>
            <div class="message <?php echo $messageClass; ?>"><?php echo h($message); ?></div>
        <?php endif; ?>
        <form method="post" action="register.php">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo h($username); ?>">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="<?php echo h($password); ?>">

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="confirm_password" value="<?php echo h($confirm); ?>">

            <button type="submit">Register</button>
        </form>
    </div>
</div>
</body>
</html>
