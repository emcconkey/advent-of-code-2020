<?php
require_once("inputs/day13.php");
echo "Day 13, problem 1\n";


$start_time = microtime(true);
$input = explode("\n", $input);
$starttime = intval($input[0]);
$times = $input[1];
$bustimes = [];
$mtimes = [];

foreach(explode(",", $times) as $t) {
    if($t!="x") {
        $leftover = (intval($starttime / $t)+1) * $t  - $starttime;
        $bustimes[$leftover * $t] = $leftover;
    }
}
asort($bustimes);

foreach($bustimes as $b => $sort) {
    echo "Bustime: $b\n";
    break;
}

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";