<?php
session_start();
require_once 'includes/functions.php';

$userFile = __DIR__ . '/data/users.txt';
$error = '';
$lastUser = $_COOKIE['mellow_last_user'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim((string) filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW));
    $password = trim((string) filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW));

    $user = findUser($userFile, $username);

    if ($username === '' || $password === '') {
        $error = 'Please enter your username and password.';
    } elseif (!$user || !password_verify($password, $user['password'])) {
        $error = 'Invalid login.';
    } else {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $user['username'];
        setcookie('mellow_last_user', $user['username'], time() + (60 * 60 * 24 * 30));
        header('Location: dashboard.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <div class="nav"><a href="index.php">Home</a><span class="muted">Starter Version</span></div>
    <div class="card">
        <h1>Login</h1>
        <?php if ($error !== ''): ?><div class="notice error"><?php echo h($error); ?></div><?php endif; ?>
        <form method="post" action="login.php">
            <div>
                <label for="username">Username</label>
                <input id="username" name="username" value="<?php echo h(oldValue('username', $lastUser)); ?>">
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" type="password" name="password">
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</div>
</body>
</html>
