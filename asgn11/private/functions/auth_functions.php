<?php
declare(strict_types=1);

// Check whether a Member is logged in.
function is_logged_in(): bool
{
    return isset($_SESSION['member_id']);
}

// Prevent Visitors from accessing protected pages.
function require_login(): void
{
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}
