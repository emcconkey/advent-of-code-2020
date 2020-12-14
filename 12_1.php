<?php
require_once("inputs/day12.php");
echo "Day 12, problem 1\n";

$input = <<<EOF
F10
N3
F7
R90
F11
EOF;



$start_time = microtime(true);
$input = array_map(function($x) {  return [ substr($x, 0, 1), intval(substr($x, 1))]; }, explode("\n", $input));

$directions = ["E", "S", "W", "N"];
$headingint = 0;
$heading = "E";
$position = [ "E" => 0, "N" => 0, "W" => 0, "S" => 0 ];
$p = ["N" => 0, "E" => 0];
$count = 0;
foreach($input as $instruction) {
    $count++;
    $dir = $instruction[0];
    $amt = $instruction[1];
    switch($dir) {
        case "F":
            //echo "Moving F($heading) $amt\n";
            $position[$heading] += $amt;
            break;
        case "N":
        case "S":
        case "E":
        case "W":
            //echo "Moving $dir $amt\n";
            $position[$dir] += $amt;
            break;
        case "R":
            $newval = $amt / 90;
            $headingint = ($headingint + $newval) % 4;
            $heading = $directions[$headingint];
            //echo "Turned R $amt new heading $heading\n";
            break;
        case "L":
            $newval = $amt / 90;
            $headingint = (4 + ($headingint - $newval)) % 4;
            $heading = $directions[$headingint];
            //echo "Turned L $amt new heading $heading\n";
            break;
        default:
            echo "Error\n";
            break;
    }
    //echo "New position: N: {$position["N"]}, S: {$position["S"]}, E: {$position["E"]}, W: {$position["W"]}\n";
}

$npos = abs($position["N"] - $position["S"]);
$epos = abs($position["E"] - $position["W"]);

$location = $npos + $epos;

echo "Final position: $npos, $epos, $location\n";

//var_dump($input);

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";