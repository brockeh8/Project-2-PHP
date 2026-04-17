<?php
require_once 'includes/auth.php';
require_once 'includes/functions.php';
resetGameState();
header('Location: lobby.php');
exit;
?>