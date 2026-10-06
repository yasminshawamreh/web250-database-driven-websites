# Bike and Bird Challenge

## Student

Yasmin Shawamreh

## Course

WEB 250

## Project Overview

This project demonstrates PHP object-oriented programming using bicycle and bird data. It uses classes, constructors, methods, CSV parsing, data conversion, escaping, and Git branches.

## Bike Challenge

The Bike Challenge uses a Bicycle class to represent bicycle inventory from a CSV file. It demonstrates properties, constants, constructors, getters and setters, methods, CSV parsing, and escaped output.

## Bird Challenge

The Bird Challenge uses a Bird class to represent bird data from a CSV file. It demonstrates properties, constants, constructors, getters and setters, unit conversions, a conservation lookup, size classification, a static object counter, and static methods.

## Go Further Choices

1. Static Finder

2. `__toString()`

## Concept Check

### 1. Static Property vs Constant

A static property can change while the program is running, while a constant cannot be changed after it is defined. `Bird::$count` is a static property because it needs to increase each time a Bird object is created.

### 2. Constructor `$args` Array

Using one `$args` array keeps the constructor connected to the CSV column names instead of depending on the order of separate parameters. If the CSV columns are reordered, the values can still be assigned using their column names.

### 3. Public vs Protected

Public properties can be accessed directly from outside the class. Protected properties can only be accessed inside the class or by classes that inherit from it. Measurements and coded IDs are protected so the class can control how those values are stored and displayed.

### 4. Private `reset()`

A private `reset()` method can only be called from inside the class. This keeps an internal operation from being called directly by code outside the class.

### 5. `self::CONSERVATION_OPTIONS`

`self::` is used because `CONSERVATION_OPTIONS` is a class constant, not an object property. The constant belongs to the Bird class itself, so it is accessed through the class rather than through `$this`.

### 6. `money_format()` vs `number_format()`

`money_format()` was designed for currency formatting and is not available in modern PHP versions. `number_format()` is used to format numbers and works for displaying the bird measurements with the required decimal places and unit labels.

## Git History

```text
* 0ee6085 (HEAD -> main, origin/main, origin/asgn05-bird, asgn05-bird) asgn05-bird: complete README
* e95fd15 asgn05-bird: add bird string representation
* 8ff6a37 asgn05-bird: clarify size class documentation
* 4bd0ed2 asgn05-bird: document constructor design
* 5b00ce3 asgn05-bird: complete bird challenge
* fdafe01 (origin/asgn05-bike, asgn05-bike) asgn05-bike: complete inventory display and escaping
* 142d3c8 asgn05-bike: connect ParseCSV to inventory page
* b7c0a76 asgn05-bike: complete Bicycle properties and constructor
* 2666faa asgn05-bike: add starter inventory page
* 27ff9f8 (origin/asgn04-constructor, asgn04-constructor) Complete autoload exercise
* 3963543 Complete asgn04 constructors
* 864dbd2 Starting asgn04-constructors
* 87a373f Merge asgn03-static into main
* 35549e4 (origin/asgn03-static, asgn03-static) Complete asgn03-static
* 6eb1ce0 Complete static properties and methods
* abccf30 Add asgn03-static starter files
* bf39fa2 Merge branch 'main' of https://github.com/yasminshawamreh/web250-database-driven-websites
|\
| * 10f3214 bird-challenge.php
```

## AI Log

I used AI for guidance, code review, and troubleshooting while completing this assignment. I used it to help me understand PHP OOP concepts, check assignment requirements, and troubleshoot errors. I reviewed and tested the suggestions myself and made the final decisions about my code.
