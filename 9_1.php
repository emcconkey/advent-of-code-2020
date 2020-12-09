<?php
require_once("inputs/day9.php");
echo "Day 9, problem 1\n";


$start_time = microtime(true);
$input = array_map(function($x) { return intval($x); }, explode("\n", $input));
$pl = 25; // preamble length
$slice = [];

for($i=0;$i<$pl;$i++) {
    $slice[$i] = 0;
}

for($i=0;$i<count($input);$i++) {

    if($i < $pl) {
        array_shift($slice);
        array_push($slice, $input[$i]);
        continue;
    }

    $valid_number = false;

    foreach($slice as $x) {
        foreach($slice as $y) {
            if($x + $y == $input[$i]) {
                $valid_number = true;
            }
        }
    }
    if(!$valid_number) {
        echo "Invalid number: {$input[$i]}\n";
        break;
    }
    array_shift($slice);
    array_push($slice, $input[$i]);
}


$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";
