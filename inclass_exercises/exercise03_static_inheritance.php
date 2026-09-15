<?php
class TradInstrument {
    // This static property is shared at the class level.
    public static int $registeredCount = 0;

    // A static method that changes the shared static property.
    public static function registerInstrument(): void {
    self::$registeredCount++;
    print "Instrument registered." . PHP_EOL;
    }

    // A static method for displaying the count.
    public static function showCount(): void {
        print "Registered instruments: " . self::$registeredCount . PHP_EOL;
    }

    // A normal method can still exist in the same class.
    public function describe(): void {
        print "This is an Irish traditional instrument." . PHP_EOL;
    }

}


// Fiddle inherits everything from TradInstrument.
class Fiddle extends TradInstrument {
    public function describe(): void {
        print "The fiddle is a bowed string instrument." . PHP_EOL;
    }
    public static function tuning(): void {
        print "Fiddle tuning: G D A E" . PHP_EOL;
    }
    public static function registerFiddle(): void {
        print "Registering a fiddle..." . PHP_EOL;
        // parent:: refers to the parent class.
        parent::registerInstrument();
    }

}

// Concertina also inherits from TradInstrument.
class Concertina extends TradInstrument {
    public function describe(): void {
        print "The concertina is a free-reed instrument." . PHP_EOL;
    }
    public static function tuning(): void {
        print "Anglo concertina: commonly C/G" . PHP_EOL;
    }
}

// Whistle also inherits from TradInstrument.
class Whistle extends TradInstrument {
    public function describe(): void {
        print "The tin whistle is a simple six-hole wind instrument." . PHP_EOL;
    }
}

class UilleannPipes extends TradInstrument {
    public function describe(): void {
        print "Uilleann pipes are an Irish bellows-blown bagpipe." . PHP_EOL;
    }
}

// Call the inherited static method through the child classes.
Fiddle::registerFiddle();
echo "<br>";
Fiddle::tuning();
echo "<br>";
Concertina::tuning();
echo "<br>";
Concertina::registerInstrument();
echo "<br>";
Whistle::registerInstrument();
echo "<br>";
UilleannPipes::registerInstrument();
echo "<br>";

// The counter is shared through the inheritance hierarchy.
TradInstrument::showCount();
echo "<br>";

// We can still create normal objects.
$fiddle = new Fiddle();
echo "<br>";
$concertina = new Concertina();
$fiddle->describe();
echo "<br>";
$concertina->describe();

?>
