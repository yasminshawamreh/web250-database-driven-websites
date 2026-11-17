<?php
declare(strict_types=1);

session_start();

// Remove all session information.
$_SESSION = [];

// Delete the session cookie if one exists.
if (ini_get('session.use_cookies')) {
    $params = session_get_cookie_params();

    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $params['path'],
        'domain' => $params['domain'],
        'secure' => $params['secure'],
        'httponly' => $params['httponly']
    ]);
}

// End the session.
session_destroy();

// Return to the public Bird directory.
header('Location: birds.php');
exit;
