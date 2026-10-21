<?php

declare(strict_types=1);
header('Content-Type: text/plain; charset=UTF-8');

/**
 * EXERCISE 04: The code runs without a PHP exception but produces the
 * wrong answer. Use Watch and Step Over before making a minimal correction.
 * Add a short comment near your correction describing the original mistake.
 */
function countBirds(array $counts): int
{
    $total = 0;
    foreach ($counts as $count) {
        $total += $count;  // Fixed: The original code replaced the total instead of adding to it.
    }
    return $total;
}

$counts = [2, 3, 4];
$result = countBirds($counts);
print "Birds counted: {$result}\n";
