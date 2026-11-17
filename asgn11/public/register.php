<?php
declare(strict_types=1);

require_once __DIR__ . '/../private/initialize.php';

$errors = [];
$first_name = '';
$last_name = '';
$email = '';
$username = '';
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($first_name === '' || $last_name === '' ||
        $email === '' || $username === '' ||
        $password === '' || $confirm_password === '') {
        $errors[] = 'All fields are required.';
    }

    if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($username !== '' && Member::find_by_username($username) !== null) {
        $errors[] = 'That username is already taken.';
    }

    if ($email !== '' && Member::find_by_email($email) !== null) {
        $errors[] = 'That email address is already registered.';
    }

    if (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    }

    if ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $member = new Member();
        $member->first_name = $first_name;
        $member->last_name = $last_name;
        $member->email = $email;
        $member->username = $username;
        $member->password_hash = password_hash($password, PASSWORD_DEFAULT);
        $member->role = 'member';

        try {
            if ($member->create()) {
                $success = true;
            } else {
                $errors[] = 'Registration failed. Please try again.';
            }
        } catch (PDOException $e) {
            $errors[] = 'Registration failed. Please try again.';
        }
    }
}

function display_value(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Registration - WNC Birds</title>
</head>
<body>
    <h1>Register as a Member</h1>
    <p><a href="birds.php">Back to Birds</a></p>

    <?php if ($success): ?>
        <p>Registration successful! You can now log in.</p>
    <?php else: ?>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= display_value($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post">
            <p>
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name"
                       value="<?= display_value($first_name) ?>" required>
            </p>

            <p>
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name"
                       value="<?= display_value($last_name) ?>" required>
            </p>

            <p>
                <label for="email">Email</label>
                <input type="email" id="email" name="email"
                       value="<?= display_value($email) ?>" required>
            </p>

            <p>
                <label for="username">Username</label>
                <input type="text" id="username" name="username"
                       value="<?= display_value($username) ?>" required>
            </p>

            <p>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </p>

            <p>
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password"
                       name="confirm_password" required>
            </p>

            <button type="submit">Register</button>
        </form>
    <?php endif; ?>
</body>
</html>
