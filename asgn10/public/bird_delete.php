<?php

declare(strict_types=1);

require_once dirname(__DIR__) . '/private/initialize.php';

$error_message = '';
$bird = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = filter_input(
        INPUT_POST,
        'id',
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );
} else {
    $id = filter_input(
        INPUT_GET,
        'id',
        FILTER_VALIDATE_INT,
        ['options' => ['min_range' => 1]]
    );
}

if ($id === false || $id === null) {
    $error_message = 'Invalid or missing Bird ID.';
} else {
    $bird = Bird::find_by_id($id);

    if ($bird === null) {
        $error_message = 'The requested bird could not be found.';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($bird->delete()) {
            header('Location: birds.php');
            exit;
        }

        $error_message = 'The bird could not be deleted.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Delete Bird</title>
</head>
<body>
    <h1>Delete Bird</h1>

    <p><a href="birds.php">Back to bird directory</a></p>

    <?php if ($error_message !== ''): ?>
        <p><?= h($error_message) ?></p>
    <?php endif; ?>

    <?php if ($bird !== null && $_SERVER['REQUEST_METHOD'] !== 'POST'): ?>
        <p>Bird ID: <?= (int) $bird->id ?></p>
        <p>Common name: <?= h($bird->common_name) ?></p>

        <p>Are you sure you want to delete this Bird?</p>

        <form method="post" action="bird_delete.php">
            <input type="hidden" name="id" value="<?= (int) $bird->id ?>">

            <button type="submit">Delete Bird</button>
            <a href="birds.php">Cancel</a>
        </form>
    <?php endif; ?>
</body>
</html>

