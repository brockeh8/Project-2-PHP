<?php
session_start();
require_once 'includes/functions.php';

$userFile = __DIR__ . '/data/users.txt';
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW));
    $password = trim((string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW));
    $confirm = trim((string) filter_input(INPUT_POST, 'confirm_password', FILTER_UNSAFE_RAW));

    if ($username === '' || $password === '' || $confirm === '') {
        $error = 'Please fill in all fields.';
    } elseif (!preg_match('/^[A-Za-z0-9_]{3,20}$/', $username)) {
        $error = 'Username must be 3-20 characters and only use letters, numbers, or underscores.';
    } elseif ($password !== $confirm) {
        $error = 'Passwords do not match.';
    } elseif (findUser($userFile, $username)) {
        $error = 'That username already exists.';
    } else {
        saveUser($userFile, $username, $password);
        $success = 'Registration successful. You can log in now.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="nav"><a href="index.php">Home</a><span class="muted">Starter Version</span></div>
    <div class="card">
        <h1>Register</h1>
        <?php if ($error !== ''): ?><div class="notice error"><?php echo h($error); ?></div><?php endif; ?>
        <?php if ($success !== ''): ?><div class="notice success"><?php echo h($success); ?></div><?php endif; ?>
        <form method="post" action="register.php">
            <div>
                <label for="username">Username</label>
                <input id="username" name="username" value="<?php echo h(oldValue('username')); ?>">
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
            </div>
            <div>
                <label for="confirm_password">Confirm Password</label>
                <input id="confirm_password" type="password" name="confirm_password">
            </div>
            <button type="submit">Create Account</button>
        </form>
    </div>
</div>
</body>
</html>
