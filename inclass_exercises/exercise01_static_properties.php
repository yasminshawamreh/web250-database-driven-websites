<?php
class TradInstrument {
    // A normal property belongs to an individual object.
    public string $name = "";
    // A static property belongs to the CLASS.
    //
    // There is only ONE copy of this variable,
    // no matter how many TradInstrument objects we create.
    public static int $instrumentCount = 0;

    public static string $tradition = "Irish Traditional Music";
}

// Create our first instrument object.
$fiddle = new TradInstrument();

// Set the object's normal property.
$fiddle->name = "Fiddle";

// Increase the class-wide counter.
//
// Notice that we use the class name followed by ::
//
// We do NOT write:
// $fiddle->instrumentCount
//
// Static properties are normally accessed with:
// ClassName::$propertyName
TradInstrument::$instrumentCount++;


// Create a second instrument.
$concertina = new TradInstrument();
$concertina->name = "Concertina";


// Increase the same shared counter.
TradInstrument::$instrumentCount++;


// Create a third instrument.
$whistle = new TradInstrument();
$whistle->name = "Tin Whistle";

// Increase the same shared counter again.
TradInstrument::$instrumentCount++;


// Create a fourth instrument.
$pipes = new TradInstrument();
$pipes->name = "Uilleann Pipes";

// Increase the same shared counter again.
TradInstrument::$instrumentCount++;

// Create a fifth instrument.
$banjo = new TradInstrument();
$banjo->name = "Banjo";

// Increase the same shared counter again.
TradInstrument::$instrumentCount++;


// Display the names stored in the individual objects.
print "Instrument 1: " . $fiddle->name . PHP_EOL;
print "<br>Instrument 2: " . $concertina->name . PHP_EOL;
print "<br>Instrument 3: " . $whistle->name . PHP_EOL;
print "<br>Instrument 4: " . $pipes->name . PHP_EOL;
print "<br>Instrument 5: " . $whistle->name . PHP_EOL;


// Display the ONE shared static property.
print "<br>Total instruments created: " . TradInstrument::$instrumentCount .
PHP_EOL;

// Irish Traditional Music 
print "<br>Music Tradition: " . TradInstrument::$tradition . PHP_EOL;

?>
