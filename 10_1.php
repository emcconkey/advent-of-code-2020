<?php
require_once("inputs/day10.php");
echo "Day 10, problem 1\n";

$start_time = microtime(true);
$adapters = array_map(function($x) { return intval($x); }, explode("\n", $input));
sort($adapters);
$highest_jolt = $adapters[count($adapters)-1] + 3;

$jdiff1 = 0;
$jdiff3 = 0;

array_reduce($adapters, function($x, $y) {
    global $jdiff1, $jdiff3;
    match($y-$x) {
        1 => $jdiff1++,
        3 => $jdiff3++
    };
    return $y;
}, 0);
$jdiff3++; // for the device input joltage

echo "Highest jolt: $highest_jolt\n";
echo "3 diffs     : $jdiff3\n";
echo "1 diffs     : $jdiff1\n";
echo "Product     : " . ($jdiff3 * $jdiff1) . "\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";
