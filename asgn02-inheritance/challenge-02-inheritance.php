<?php

class Instrument
{
    public $name;
    public $brand;

    public function play()
    {
        echo "The {$this->name} is being played.<br>";
    }
}

class Guitar extends Instrument
{
    public $strings;

    public function tune()
    {
        echo "The {$this->name} has {$this->strings} strings and is being tuned.<br>";
    }
}

class Piano extends Instrument
{
    public $keys;

    public function tune()
    {
        echo "The {$this->name} has {$this->keys} keys and is being tuned.<br>";
    }
}


// Create a Guitar object
$guitar = new Guitar();
$guitar->name = "Guitar";
$guitar->brand = "Fender";
$guitar->strings = 6;


// Create a Piano object
$piano = new Piano();
$piano->name = "Piano";
$piano->brand = "Yamaha";
$piano->keys = 88;


// Demonstrate inherited method
$guitar->play();
$piano->play();


// Demonstrate subclass methods
$guitar->tune();
$piano->tune();

?>
