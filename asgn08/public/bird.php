<?php

require_once __DIR__ . '/../private/initialize.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if ($id === false || $id === null) {
    http_response_code(400);
    exit('Invalid bird ID.');
}

try {
    $database = Database::connect();
    Bird::set_database($database);
    $bird = Bird::find_by_id($id);
} catch (PDOException $exception) {
    http_response_code(500);
    error_log($exception->getMessage());
    exit('Could not load bird details.');
}

if ($bird === null) {
    http_response_code(404);
    exit('Bird not found.');
}

?>
<!doctype html>
<html lang="en">
<head><meta charset="utf-8"><title>Bird Details</title></head>
<body>
    <h1>Bird Details</h1>
    <dl>
    <dt>ID</dt>
    <dd><?= (int) $bird->id ?></dd>

    <dt>Common Name</dt>
    <dd><?= h($bird->common_name) ?></dd>

    <dt>Scientific Name</dt>
    <dd><?= h($bird->scientific_name) ?></dd>

    <dt>Family Name</dt>
    <dd><?= h($bird->family_name) ?></dd>

    <dt>Primary Habitat</dt>
    <dd><?= h($bird->primary_habitat) ?></dd>

    <dt>Seasonal Status</dt>
    <dd><?= h($bird->seasonal_status) ?></dd>

    <dt>Description</dt>
    <dd><?= h($bird->description) ?></dd>
</dl>

<p><a href="birds.php">Back to Bird Directory</a></p>
</body>
</html>
