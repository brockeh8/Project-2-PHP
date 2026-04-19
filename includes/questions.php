
<?php
$questionBank = [
    ['question' => 'Which PHP superglobal stores data across multiple pages?', 'options' => ['$_POST', '$_SESSION', '$_GET', '$_COOKIE'], 'answer' => '$_SESSION', 'difficulty' => 1],
    ['question' => 'Which request method is best for sending passwords?', 'options' => ['GET', 'POST', 'LINK', 'FETCH'], 'answer' => 'POST', 'difficulty' => 1],
    ['question' => 'Which function helps safely display user input?', 'options' => ['trim()', 'explode()', 'htmlspecialchars()', 'count()'], 'answer' => 'htmlspecialchars()', 'difficulty' => 1],
    ['question' => 'What does session_start() do?', 'options' => ['Ends the page', 'Starts or resumes a session', 'Deletes cookies', 'Hashes a password'], 'answer' => 'Starts or resumes a session', 'difficulty' => 1],
    ['question' => 'Which function checks whether a variable exists?', 'options' => ['isset()', 'array_push()', 'strlen()', 'unlink()'], 'answer' => 'isset()', 'difficulty' => 2],
    ['question' => 'Which function safely hashes passwords in PHP?', 'options' => ['md5()', 'sha1()', 'password_hash()', 'cryptit()'], 'answer' => 'password_hash()', 'difficulty' => 2],
    ['question' => 'What does header("Location: page.php") usually do?', 'options' => ['Prints a title', 'Redirects the browser', 'Creates a cookie', 'Reads a file'], 'answer' => 'Redirects the browser', 'difficulty' => 2],
    ['question' => 'Which file storage style is allowed for this project?', 'options' => ['MySQL only', 'PostgreSQL only', 'Flat files or arrays', 'Firebase'], 'answer' => 'Flat files or arrays', 'difficulty' => 2],
    ['question' => 'What is the best description of a cookie?', 'options' => ['A server-only variable', 'A small value saved in the browser', 'A database row', 'A CSS class'], 'answer' => 'A small value saved in the browser', 'difficulty' => 3],
    ['question' => 'What does session_destroy() do?', 'options' => ['Creates a session', 'Ends the current session', 'Writes to a file', 'Escapes HTML'], 'answer' => 'Ends the current session', 'difficulty' => 3],
    ['question' => 'Which loop can process each question in an array?', 'options' => ['foreach', 'header', 'echo', 'cookie'], 'answer' => 'foreach', 'difficulty' => 3],
    ['question' => 'Why should game logic be handled in PHP for this project?', 'options' => ['Because static HTML is required', 'Because the rubric wants server-side logic', 'Because CSS stores sessions', 'Because PHP replaces HTML'], 'answer' => 'Because the rubric wants server-side logic', 'difficulty' => 3],
];
