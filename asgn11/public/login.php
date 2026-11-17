<?php
declare(strict_types=1);

require_once __DIR__ . '/../private/initialize.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $password === '') {
        $errors[] = 'Username and password are required.';
    } else {
        $member = Member::find_by_username($username);

        if ($member !== null &&
            password_verify($password, $member->password_hash)) {

            session_regenerate_id(true);

            $_SESSION['member_id'] = $member->id;
            $_SESSION['username'] = $member->username;
            $_SESSION['role'] = $member->role;

            header('Location: birds.php');
            exit;
        }

        $errors[] = 'Invalid username or password.';
    }
}

function escape_html(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Login - WNC Birds</title>
</head>
<body>
    <h1>Member Login</h1>

    <p><a href="birds.php">Back to Birds</a></p>

    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= escape_html($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post">
        <p>
            <label for="username">Username</label>
            <input
                type="text"
                id="username"
                name="username"
                value="<?= escape_html($username) ?>"
                required
            >
        </p>

        <p>
            <label for="password">Password</label>
            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </p>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
</body>
</html>
