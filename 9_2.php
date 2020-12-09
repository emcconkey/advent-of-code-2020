<?php
require_once("inputs/day9.php");
echo "Day 9, problem 2\n";


$start_time = microtime(true);
$input = array_map(function($x) { return intval($x); }, explode("\n", $input));
$pl = 25; // preamble length
$slice = [];
$invalid_number = 0;

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
        $invalid_number = $input[$i];
        echo "Invalid number: $invalid_number\n";
        break;
    }
    array_shift($slice);
    array_push($slice, $input[$i]);
}

$found = false;
$offset = 0;
$next = 0;
$sum = 0;
$slice = [];
while($found == false) {
    $next = $offset;
    $slice = [];
    while(array_sum($slice) < $invalid_number) {
        $slice[] = $input[$next];
        $next++;
    }

    if(count($slice) == 1) continue;

    if(array_sum($slice) == $invalid_number) {
        sort($slice);
        $smallest = $slice[0];
        $largest = $slice[count($slice)-1];
        echo "Smallest      : $smallest\n";
        echo "Largest       : $largest\n";
        echo "Sum           : " . ($smallest + $largest) . "\n";
        break;
    }
    $offset++;
}

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";
