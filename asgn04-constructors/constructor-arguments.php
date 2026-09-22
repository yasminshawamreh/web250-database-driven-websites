<?php

class Bird {

    public $commonName;
    public $latinName;

    public function __construct($args) {
        $this->commonName = $args['commonName'] ?? '';
        $this->latinName = $args['latinName'] ?? '';
    }

}

$flycatcher = new Bird([
    'commonName' => 'Acadian Flycatcher',
    'latinName' => 'Turdus migratorius'
]);

$easternTowhee = new Bird([
    'commonName' => 'Eastern Towhee',
    'latinName' => 'Pipilo erythrophthalmus'
]);

echo "Common name: " . $flycatcher->commonName . "<br>";
echo "Latin name: " . $flycatcher->latinName . "<br>";
echo "-------------------------------------<br>";

echo "Common name: " . $easternTowhee->commonName . "<br>";
echo "Latin name: " . $easternTowhee->latinName . "<br>";


?>
