<?php
require_once("inputs/day1.php");
echo "Day 1, problem 1\n";

$start_time = microtime(true);

$input = explode("\n", $input);
$short_list = [];
$long_list = [];
foreach($input as $i) {
    if(strlen($i) < 4) {
        $short_list[] = $i;
    } else {
        $long_list[] = $i;
    }
}

foreach($short_list as $s) {
    foreach($long_list as $l) {
        if($s + $l == 2020) {
            echo "Found $s + $l = 2020\n";
            echo "Result: " . ($s * $l) . "\n";
            break(2);
        }
    }
}

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

