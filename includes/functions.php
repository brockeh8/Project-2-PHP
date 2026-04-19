<?php

function h($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

function usersFile() {
    return __DIR__ . '/../data/users.txt';
}

function leaderboardFile() {
    return __DIR__ . '/../data/leaderboard.txt';
}

function ensureDataFilesExist() {
    $files = [usersFile(), leaderboardFile()];
    foreach ($files as $file) {
        if (!file_exists($file)) {
            file_put_contents($file, '');
        }
    }
}

function loadUsers() {
    ensureDataFilesExist();
    $users = [];
    $lines = file(usersFile(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) >= 2) {
            $users[] = [
                'username' => $parts[0],
                'password' => $parts[1]
            ];
        }
    }

    return $users;
}

function usernameExists($username) {
    foreach (loadUsers() as $user) {
        if (strcasecmp($user['username'], $username) === 0) {
            return true;
        }
    }
    return false;
}

function registerUser($username, $password) {
    $file = __DIR__ . '/../data/users.txt';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $line = $username . '|' . $hashedPassword . PHP_EOL;
    file_put_contents($file, $line, FILE_APPEND);
}

function verifyLogin($username, $password) {
    foreach (loadUsers() as $user) {
        if (strcasecmp($user['username'], $username) === 0 && password_verify($password, $user['password'])) {
            return true;
        }
    }
    return false;
}

function getOtherUsers($currentUsername) {
    $others = [];
    foreach (loadUsers() as $user) {
        if (strcasecmp($user['username'], $currentUsername) !== 0) {
            $others[] = $user['username'];
        }
    }
    sort($others, SORT_NATURAL | SORT_FLAG_CASE);
    return $others;
}

function loadLeaderboard() {
    ensureDataFilesExist();
    $rows = [];
    $lines = file(leaderboardFile(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        $parts = explode('|', $line);
        if (count($parts) >= 3) {
            $rows[] = [
                'username' => $parts[0],
                'score' => (int)$parts[1],
                'date' => $parts[2]
            ];
        }
    }

    usort($rows, function ($a, $b) {
        return $b['score'] <=> $a['score'];
    });

    return $rows;
}

function saveLeaderboardEntry($username, $score) {
    $line = $username . '|' . (int)$score . '|' . date('Y-m-d H:i:s') . PHP_EOL;
    file_put_contents(leaderboardFile(), $line, FILE_APPEND | LOCK_EX);
}

function requireLogin() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['logged_in'])) {
        header('Location: login.php');
        exit;
    }
}

function difficultyLabel($level) {
    if ($level <= 2) {
        return 'Easy';
    }
    if ($level <= 4) {
        return 'Medium';
    }
    return 'Hard';
}
