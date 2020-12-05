<?php
require_once("inputs/day5.php");
echo "Day 5, problem 1\n";

$start_time = microtime(true);
$rows = explode("\n", $input);
$seat_ids = [];

foreach($rows as $boarding_pass) {
    $boarding_pass = strtr($boarding_pass, "BFRL", "1010");
    $row = bindec(substr($boarding_pass, 0, 7));
    $seat = bindec(substr($boarding_pass, 7, 3));
    $seat_ids[] = ($row * 8) + $seat;
}

$my_seat = find_missing_seat_id($seat_ids);
echo "My seat ID is: $my_seat\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

function find_missing_seat_id($seat_ids) {
    sort($seat_ids);
    $seat_compare = [];
    $start = $seat_ids[0];
    foreach($seat_ids as $id) {
        $seat_compare[$start] = $id;
        $start++;
    }
    foreach($seat_compare as $k => $v) {
        if($k != $v) {
            return $k;
        }
    }
}