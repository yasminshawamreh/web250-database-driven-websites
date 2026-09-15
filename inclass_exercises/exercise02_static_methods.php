<?php
class TradInstrumentHelper {
    // A static property can be used by static methods.
    public static string $sessionPitch = "A = 440 Hz";
    // This is a STATIC METHOD.
    //
    // Notice the word "static" in the method declaration.
    //
    // Because this method belongs to the class,
    // we can call it without making an object.

    public static function showSessionPitch(): void {
        print "Standard session pitch: " . self::$sessionPitch . PHP_EOL;
    }
    
    
    // Another static method.
    //
    
    // This method accepts the name of an instrument
    // and prints a simple tuning suggestion.
    public static function showTuning(string $instrument): void {
    // strtolower() makes comparison easier.
        $instrument = strtolower($instrument);
        if ($instrument === "fiddle") {
        print "Fiddle tuning: G D A E" . PHP_EOL;
        } elseif ($instrument === "tenor banjo") {
        print "Tenor banjo tuning: G D A E" . PHP_EOL;
        } elseif ($instrument === "tin whistle") {
        print "Tin whistle: commonly played in D" . PHP_EOL;
        } elseif ($instrument === "concertina") {
        print "Anglo concertina: commonly C/G" . PHP_EOL;
        } elseif ($instrument === "uilleann pipes") {
        print "Uilleann pipes: usually pitched in D for modern session playing" . PHP_EOL;
        } else {
        print "No tuning information is available for that instrument."
        . PHP_EOL;
        }
    }

    public static function sessionReminder(): void {
        print "Tune before the session starts." . PHP_EOL;
    }

    public static function compareTuning(string $instrument1, string $instrument2): void {
        print "Comparing Fiddle and Tenor Banjo" . PHP_EOL;
    }
}


// We do NOT need to write:
// $helper = new TradInstrumentHelper();
//
// Instead, call static methods directly with the class name.
TradInstrumentHelper::showSessionPitch();
echo "<br>";

TradInstrumentHelper::sessionReminder();
echo "<br>";

TradInstrumentHelper::showTuning("Uilleann Pipes");
echo "<br>";

TradInstrumentHelper::showTuning("Fiddle");
echo "<br>";
TradInstrumentHelper::showTuning("Tenor Banjo");
echo "<br>";
TradInstrumentHelper::showTuning("Concertina");
echo "<br>";
TradInstrumentHelper::compareTuning("Fiddle", "Tenor Banjo");


?>
