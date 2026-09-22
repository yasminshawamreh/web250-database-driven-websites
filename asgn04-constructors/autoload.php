<?php

function my_autoload($class)
{
    if (preg_match('/\A\w+\Z/', $class)) {
        include 'classes/' . $class . '.class.php';
    }
}

spl_autoload_register('my_autoload');

$flycatcher = new Bird([
    'commonName' => 'Acadian Flycatcher',
    'latinName' => 'Turdus migratorius'
]);

echo "Common name: " . $flycatcher->commonName . "<br>";
echo "Latin name: " . $flycatcher->latinName . "<br>";

?>
