<?php

class Bird {

    public $commonName;
    public $food;
    public $nestPlacement;
    public $conservationLevel;
    public $song;
    public $canFly;

    public function song() {
        echo "The {$this->commonName} sings {$this->song}<br>";
    }

    public function canFly() {
        if ($this->canFly == true) {
            echo "The {$this->commonName} can fly.<br>";
        } else {
            echo "The {$this->commonName} cannot fly.<br>";
        }
    }

}

// Bird 1
$bird1 = new Bird;

$bird1->commonName = 'Eastern Towhee';
$bird1->food = 'seeds, fruits, insects, spiders';
$bird1->nestPlacement= 'Ground';
$bird1->conservationLevel = 'Low';
$bird1->song = '"drink-your-tea"';
$bird1->canFly = true;

// Bird 2
$bird2 = new Bird;

$bird2->commonName = 'Indigo Bunting';
$bird2->food = 'small seeds, buds, and insects';
$bird2->nestPlacement = 'roadsides, and railroad rights-of-wafields and on the edges';
$bird2->conservationLevel = 'Low';
$bird2->song = '"whatwhat!!"';
$bird2->canFly = true;


// Display Bird 1
echo "<b>{$bird1->commonName}</b><br>";
echo "Food: {$bird1->food}<br>";
echo "Nest placement: {$bird1->nestPlacement}<br>";
echo "Conservation level: {$bird1->conservationLevel}<br>";

$bird1->song();
$bird1->canFly();

// Display Bird 2
echo "<br><b>{$bird2->commonName}</b><br>";
echo "Food: {$bird2->food}<br>";
echo "Nest placement: {$bird2->nestPlacement}<br>";
echo "Conservation level: {$bird2->conservationLevel}<br>";

$bird2->song();
$bird2->canFly();

?>

