<?php

class Bird {
    var $habitat;
    var $food;
    var $nesting = "tree";
    var $conservation;
    var $song = "chirp";

    public static $flying = "yes";

    public static $instance_count = 0;
    public static $egg_num = 0;

    public static function create() {
        self::$instance_count++;
        return new Bird();
    }

    function can_fly() {
        return (static::$flying == "yes") ? "bird can fly" : "is stuck on the ground";
    }
}

class YellowBelliedFlyCatcher extends Bird {
    var $name = "yellow-bellied flycatcher";
    var $diet = "mostly insects.";
    var $song = "flat chilk";

    public static $egg_num = "3-4, sometimes 5.";
}

class Kiwi extends Bird {
    var $name = "kiwi";
    var $diet = "omnivorous";
    
    public static $flying = "no";
}

?>
