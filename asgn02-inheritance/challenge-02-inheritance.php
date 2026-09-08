<?php

class Instrument
{
    protected $name;
    private $brand;

    public function play()
    {
        echo "The {$this->name} is being played.<br>";
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function brand() { 
        return $this->brand; 
    } 
    
    public function setBrand($value) { 
        $this->brand = $value; 
    }
}

class Guitar extends Instrument
{
    protected $strings;

    public function tune()
    {
        echo "The {$this->name} has {$this->strings} strings and is being tuned.<br>";
    }

    public function setStrings($value) { 
        $this->strings = $value; 
    }
}

class Piano extends Instrument
{
    protected $keys;

    public function tune()
    {
        echo "The {$this->name} has {$this->keys} keys and is being tuned.<br>";
    }

    public function setKeys($value) { 
        $this->keys = $value; 
    }
}


//Create a Guitar object 
$guitar = new Guitar(); 
$guitar->setName("Guitar"); 
$guitar->setBrand("Fender"); 
$guitar->setStrings(6);


// Create a Piano object
$piano = new Piano();
$piano->setName("Piano");
$piano->setBrand("Yamaha");
$piano->setKeys(88);


// Demonstrate inherited method
$guitar->play();
$piano->play();


// Demonstrate subclass methods
$guitar->tune();
$piano->tune();

// Display brands using getter 
echo "Guitar brand: " . $guitar->brand() . "<br>"; 
echo "Piano brand: " . $piano->brand() . "<br>";

?>
