<?php

class TradInstrument {
    // The parent class has a default instrument family.
    public static string $family = "General Trad Instrument";
    // This static method uses self::
    //
    // self:: refers to the class where this method
    // was originally DEFINED.
    //
    // This means self::$family refers to
    // TradInstrument::$family.

    public static function showFamily(): void {
        print "Instrument family: " . static::$family . PHP_EOL;
    }

    public static string $sessionRole = "General";
}

class Fiddle extends TradInstrument {
    public static string $family = "String";
}

class Concertina extends TradInstrument {
    public static string $family = "Free Reed";
}

class TinWhistle extends TradInstrument {
    public static string $family = "Wind";
}

// Call the inherited method through each child class.
Fiddle::showFamily();
echo "<br>";
Concertina::showFamily();
echo "<br>";
TinWhistle::showFamily();
echo "<br>";

?>
