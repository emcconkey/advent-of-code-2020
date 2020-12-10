<?php
require_once("inputs/day10.php");
echo "Day 10, problem 2\n";

$start_time = microtime(true);
$adapters = array_map(function($x) { return intval($x); }, explode("\n", $input));

sort($adapters); // Sort ascending
array_push($adapters, $adapters[count($adapters)-1]+3); // Add in our device input joltage

$counter = 0;
$totals = [];

array_reduce($adapters, function($x, $y) {
    global $counter, $totals;

    if($y - $x == 1) {
        $counter++; // Add one every time we have a jolt diff of 1
    } else {
        // Once we are done with a string of 2 or more 1 diffs, calculate the number of valid combinations and save it
        if($counter > 1) $totals[] = ((2**($counter-2)) + ($counter-1));
        $counter=0; // Reset the diff counter
    }
    return $y;
}, 0);

echo "Final number of combinations: " . array_product($totals) . "\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";
