<?php
require_once("inputs/day12.php");
echo "Day 12, problem 2\n";

$start_time = microtime(true);
$input = array_map(function($x) {  return [ substr($x, 0, 1), intval(substr($x, 1))]; }, explode("\n", $input));

$directions = ["E", "S", "W", "N"];
$headingint = 0;
$heading = "E";
$waypoint = [ "E" => 10, "N" => 1, "W" => 0, "S" => 0 ];
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
            foreach($directions as $d) {
                $position[$d] += $waypoint[$d] * $amt;
            }
            break;
        case "N":
        case "S":
        case "E":
        case "W":
            //echo "Moving waypoint $dir $amt\n";
            $waypoint[$dir] += $amt;
            break;
        case "R":
            $waypoint = rot_right($waypoint, $amt/90);
            //echo "Rotated R $amt\n";
            break;
        case "L":
            $waypoint = rot_left($waypoint, $amt/90);
            //echo "Rotated L $amt\n";
            break;
        default:
            echo "Error\n";
            break;
    }
    //echo "WP   position: N: {$waypoint["N"]}, S: {$waypoint["S"]}, E: {$waypoint["E"]}, W: {$waypoint["W"]}\n";
    //echo "Ship position: N: {$position["N"]}, S: {$position["S"]}, E: {$position["E"]}, W: {$position["W"]}\n";
}

$npos = abs($position["N"] - $position["S"]);
$epos = abs($position["E"] - $position["W"]);

$location = $npos + $epos;

echo "Final position: $npos, $epos, $location\n";

//var_dump($input);

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

function rot_right($waypoint, $amt) {
    while($amt--) {
        $waypoint = ["N" => $waypoint["W"], "S" => $waypoint["E"], "E" => $waypoint["N"], "W" => $waypoint["S"]];
    }
    return $waypoint;
}

function rot_left($waypoint, $amt) {
    while($amt--) {
        $waypoint = ["S" => $waypoint["W"], "N" => $waypoint["E"], "W" => $waypoint["N"], "E" => $waypoint["S"]];
    }
    return $waypoint;
}