<?php

class Bicycle
{
    public $brand;
    public $model;
    public $year;
    public $description = 'Used bicycle';
    public $weightKg = 0.0;

    public function name()
    {
        return $this->brand . ' ' . $this->model . ' (' . $this->year . ')';
    }

    public function weightLbs()
    {
        return floatval($this->weightKg) * 2.2046226218;
    }

    public function setWeightLbs($value)
    {
        $this->weightKg = floatval($value) / 2.2046226218;
    }
}

$trek = new Bicycle();

$trek->brand = 'Trek';
$trek->model = 'Emonda';
$trek->year = '2017';
$trek->weightKg = 1.0;

$cd = new Bicycle();
$cd->brand = 'Cannondale';
$cd->model = 'Synapse';
$cd->year = '2016';
$cd->weightKg = 8.0;

echo $trek->name() . '<br>';
echo $cd->name() . '<br>';
echo $trek->weightKg . '<br>';
echo $trek->weightLbs() . '<br>';

$trek->setWeightLbs(2);

echo $trek->weightKg . '<br>';
echo $trek->weightLbs() . '<br>';

?>

