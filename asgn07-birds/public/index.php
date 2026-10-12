<?php

require_once __DIR__ . '/../private/initialize.php';

try {
    $database = Database::connect();

    $statement = $database->query('SELECT DATABASE()');
    $database_name = (string) $statement->fetchColumn();

    $summary = [
        'Bird species' => (int) $database->query(
            'SELECT COUNT(*) FROM birds'
        )->fetchColumn(),

        'Image records' => (int) $database->query(
            'SELECT COUNT(*) FROM bird_images'
        )->fetchColumn(),

        'Bird-image links' => (int) $database->query(
            'SELECT COUNT(*) FROM bird_image_links'
        )->fetchColumn(),
    ];
} catch (PDOException $exception) {
    http_response_code(500);
    error_log('asgn07 database error: ' . $exception->getMessage());
    echo '<p>Database check failed. Check the local PHP error log.</p>';
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>asgn07 - WNC Birds Database Check</title>
</head>
<body>
    <h1>WNC Birds Database Check</h1>

    <p>Database: <?= h($database_name) ?></p>

    <table>
        <caption>Database summary</caption>
        <thead>
            <tr>
                <th scope="col">Record type</th>
                <th scope="col">Count</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($summary as $label => $count): ?>
                <tr>
                    <th scope="row"><?= h($label) ?></th>
                    <td><?= h($count) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>



// <?php
// Name:
// Course: WEB-250
// Assignment: asgn07
// Work through asgn07.md. Replace this starter page with the completed
// database check from Parts 6-7. Do not add a bird listing or image gallery.

// <!doctype html>
// <html lang="en">
// <head>
//     <meta charset="utf-8">
//     <title>asgn07 - Starter</title>
// </head>
// <body>
//     <h1>asgn07 - WNC Birds Database Check</h1>
//     <p>Complete the database import and PDO steps in asgn07.md.</p>
// </body>
// </html>
