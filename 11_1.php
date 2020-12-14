<?php
error_reporting(E_ALL & ~E_WARNING);
require_once("inputs/day11.php");
echo "Day 11, problem 1\n";

$start_time = microtime(true);
$input = explode("\n", $input);

$map = [];
$position = [];
$new_position = [];
$map_change = false;

array_map(function($x)  {
    global $map;
    global $position;

    $row = str_split($x);
    $position[] = array_fill(0, count($row), 0);
    $map[] = $row;
}, $input);

$map_change = true;
$step = 0;
while($map_change) {
    $map_change = false;
    update_map();
    $step++;
}

$occ = 0;
foreach($position as $p) {
    $occ += array_sum($p);
}

echo "No more change, steps: $step\n";
echo "Occupied seats : $occ\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

function update_map() {
    global $map;
    global $position;
    global $new_position;

    $new_position = $position;

    for($row=0;$row<count($map);$row++) {
        for($col=0;$col<count($map[$row]);$col++) {
            apply_seat_rules($row, $col);
        }
    }

    $position = $new_position;
}

function draw_map() {
    global $map;
    global $position;

    for($row=0;$row<count($map);$row++) {
        for($col=0;$col<count($map[$row]);$col++) {
            if($position[$row][$col]) {
                echo "#";
            } else {
                echo $map[$row][$col];
            }
        }
        echo "\n";
    }

}

function apply_seat_rules($row, $col) {
    global $map;
    global $new_position;
    global $map_change;

    if($map[$row][$col] == ".") return;
    $state = check_seat_state($row, $col);
    if($state == 2) {
        $new_position[$row][$col] = 0;
        $map_change = true;
    }
    if($state == 1) {
        $new_position[$row][$col] = 1;
        $map_change = true;
    }
    // Otherwise nothing changes
}

// Find all 8 neighbors and count how many are occupied
// 2 means that the seat is occupied and 4 or more neighbors are occupied, so this seat needs to become empty
// 1 means the seat is empty and there are no occupied neighbors, so this seat needs to become occupied
// 0 means the seat state does not change
function check_seat_state($row, $col) {
    global $position;
    $adjacent_count = 0;
    $xm = $ym = [-1, 0, 1];
    foreach($xm as $x) {
        foreach($ym as $y) {
            if($x==0 && $y==0) continue;
            if($position[$row-$x][$col-$y]) $adjacent_count++;
        }
    }
    if($adjacent_count >= 4 && $position[$row][$col]) return 2;
    if(!$adjacent_count && !$position[$row][$col]) return 1;
    return 0;
}
