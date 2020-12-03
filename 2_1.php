<?php
require_once("inputs/day2.php");
echo "Day 2, problem 1\n";

$start_time = microtime(true);
$valid = 0;
$invalid = 0;
$input = explode("\n", $input);
foreach($input as $i) {
    $var = explode(" ", $i);
    $count = explode("-", $var[0]);
    $letter = substr($var[1], 0, 1);
    $pw = $var[2];
    $t = substr_count($pw, $letter);
    if($t >= $count[0] && $t <= $count[1]) {
        $valid++;
    } else {
        $invalid++;
    }
}

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;

echo "Valid passwords   : $valid\n";
echo "Invalid passwords : $invalid\n";
echo "Time: " . number_format($ms_time, 3) . "ms\n";

