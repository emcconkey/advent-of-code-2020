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
rsort($seat_ids);
echo "Highest seat id: {$seat_ids[0]}\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

function find_highest_seat_id($seat_ids) {
}