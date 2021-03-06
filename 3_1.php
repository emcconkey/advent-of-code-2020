<?php
require_once("inputs/day3.php");
echo "Day 3, problem 1\n";

$start_time = microtime(true);
$position = 0;
$trees = 0;
$rows = explode("\n", $input);

$trees = get_trees($rows, 3, 1);

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;

echo "Trees Encountered: $trees\n";
echo "Time: " . number_format($ms_time, 3) . "ms\n";


// Note that $down doesn't do anything useful in this iteration
function get_trees($rows, $right, $down) {
    $trees = 0;
    $position = 0;
    echo "Slope: $right, $down\n";
    // Intentionally skip row 0 since our first check is on row 1
    for($i=1;$i<count($rows);$i++) {
        $position += $right;
        if($position > 30) $position -= 31;
        if(substr_compare($rows[$i], "#", $position, 1) === 0) {
            $trees++;
        }
    }
    echo "Trees: $trees\n";
    return $trees;
}