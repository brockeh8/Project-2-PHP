# Mellow Millionaire

Mellow Millionaire is a PHP web game inspired by **Who Wants to Be a Millionaire**. The project lets users register, log in, and play through a 15-question game while tracking progress with PHP sessions. The goal was to build something that felt fun and polished while still matching the course requirements for form processing, sessions, authentication, file handling, and PHP-driven game logic.

## Features

- User registration and login
- Password hashing with PHP
- Session-protected pages
- 15-question Millionaire-style progression
- Random question selection using easy, medium, and hard categories
- Pass lifeline
- Walk-away option
- Checkpoint-style winnings logic
- Results page with final winnings
- Leaderboard that only saves players who finish with winnings above $0
- Gold-themed responsive UI

## Project Structure

- `index.php` - landing page
- `register.php` - user registration
- `login.php` - user login
- `dashboard.php` - game intro and start page
- `game.php` - main game logic and question flow
- `results.php` - final score/winnings page
- `leaderboard.php` - leaderboard display
- `logout.php` - logs the user out
- `includes/functions.php` - helper functions
- `includes/questions.php` - question bank
- `data/users.txt` - stored user accounts
- `data/leaderboard.txt` - stored leaderboard scores
- `styles.css` - site styling

## How It Works

The user first registers an account and then logs in. After logging in, they can start a new game from the dashboard. The game randomly selects 15 questions total: 5 easy, 5 medium, and 5 hard. As the user answers questions, PHP sessions store the current level, winnings, feedback, and lifeline usage.

If the player answers correctly, they move to the next question. If they answer incorrectly, the game ends and their winnings fall to the proper checkpoint amount. If they choose to walk away, they keep what they have earned so far. At the end of the game, the results page displays the final winnings and saves the score to the leaderboard if the amount is greater than $0.

## PHP Concepts Used

This project uses several core PHP concepts from class:

- `$_SESSION` for state management
- `session_start()` and `session_destroy()`
- `$_POST` form handling
- `filter_input()` for processing input
- `htmlspecialchars()` for safe output
- `password_hash()` and `password_verify()`
- `require_once` for shared files
- flat file storage instead of a database

## Validation and Security

Basic validation and security were included throughout the project:

- empty form fields are checked
- duplicate usernames are blocked
- passwords are hashed before storage
- output is escaped with `htmlspecialchars()`
- protected pages redirect users if they are not logged in

## Setup Instructions

1. Place the project folder inside your PHP server directory.
2. Make sure the `data` folder contains:
   - `users.txt`
   - `leaderboard.txt`
3. Make sure those files are writable on the server.
4. Open the project in a browser through your local server or CODD URL.
5. Register a new account and start playing.

## Notes

This project does not use JavaScript or a database. All major functionality is handled with PHP, sessions, and flat-file storage to stay aligned with the course requirements.

## Team

- Brock Freiberger
- Jay Patel

## AI Usage Disclosure

AI was used as a support tool during development for brainstorming, debugging help, refactoring suggestions, and presentation preparation. AI also supported in helping to seed the questions and make new questions.
