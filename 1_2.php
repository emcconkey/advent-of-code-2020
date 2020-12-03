<?php
require_once("inputs/day1.php");
echo "Day 1, problem 2\n";

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

foreach($short_list as $a) {
    foreach($short_list as $b) {
        if($a == $b) continue;
        foreach($short_list as $c) {
            if($a == $c || $b == $c) continue;
            if($a + $b + $c == 2020) {
                echo "Found $a + $b + $c = 2020\n";
                echo "Answer: " . (($a * $b) * $c) . "\n";
                break(3);
            }
        }
    }
}

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";