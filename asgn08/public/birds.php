<?php

require_once __DIR__ . '/../private/initialize.php';

try {
    $database = Database::connect();
    Bird::set_database($database);
    $birds = Bird::find_all();
} catch (PDOException $exception) {
    http_response_code(500);
    error_log($exception->getMessage());
    exit('Could not load the bird directory.');
}

?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>WNC Bird Directory</title></head>
<p><a href="index.php">Back to Database Summary</a></p>
<body>
    <h1>WNC Bird Directory</h1>
    <?php if (empty($birds)): ?>
    <p>No birds were found.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th scope="col">Common Name</th>
                <th scope="col">Scientific Name</th>
                <th scope="col">Habitat</th>
                <th scope="col">Seasonal Status</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($birds as $bird): ?>
                <tr>
                    <td><?= h($bird->common_name) ?></td>
                    <td><?= h($bird->scientific_name) ?></td>
                    <td><?= h($bird->primary_habitat) ?></td>
                    <td><?= h($bird->seasonal_status) ?></td>
                    <td>
                        <a href="bird.php?id=<?= (int) $bird->id ?>">
                            View details
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
</body>
</html>
