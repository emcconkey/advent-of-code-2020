<?php
require_once("inputs/day3.php");
echo "Day 3, problem 2\n";

$start_time = microtime(true);
$position = 0;
$trees = 0;
$rows = explode("\n", $input);

// Calculate for the following slopes
//    Right 1, down 1.
//    Right 3, down 1. (This is the slope you already checked.)
//    Right 5, down 1.
//    Right 7, down 1.
//    Right 1, down 2.

$s1 = get_trees($rows, 1, 1);
$s2 = get_trees($rows, 3, 1);
$s3 = get_trees($rows, 5, 1);
$s4 = get_trees($rows, 7, 1);
$s5 = get_Trees($rows, 1, 2);

$total_trees = ($s1 + $s2 + $s3 + $s4 + $s5);
$product = ($s1 * $s2 * $s3 * $s4 * $s5);

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;

echo "Total Trees: $total_trees\n";
echo "Product of Trees Encountered: $product\n";
echo "Time: " . number_format($ms_time, 3) . "ms\n";


function get_trees($rows, $right, $down) {
    $trees = 0;
    $position = 0;
    echo "Slope: $right, $down\n";
    // Intentionally skip to our first row that we need to check
    for($i=$down;$i<count($rows);$i++) {
        $skip = $down -1;
        $position += $right;
        if($position > 30) $position -= 31;
        if(substr_compare($rows[$i], "#", $position, 1) === 0) {
            $trees++;
        }
        while($skip > 0) {
            $skip--;
            $i++;
        }
    }
    echo "Trees: $trees\n";
    return $trees;
}