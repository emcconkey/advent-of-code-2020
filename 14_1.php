<?php
require_once("inputs/day14.php");
echo "Day 14, problem 1\n";

$start_time = microtime(true);
$input = explode("\n", $input);

$memory = [];
$mask = "";
$memval = 0;
$memloc = 0;
foreach($input as $i) {
    if(substr($i, 0, 4) == "mask") {
        $tmp = explode(" ", $i);
        $mask = $tmp[2];
    } else {
        $tmp = explode(" ", $i);
        $memval = intval($tmp[2]);
        $tmp[0] = str_replace("mem[", "", $tmp[0]);
        $memloc = intval($tmp[0]);
        $memval = decbin($memval);
        set_mem($mask, $memloc, $memval);
    }
}

$total = array_sum($memory);

echo "Total memory is: $total\n";


$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";

function set_mem($mask, $memloc, $memval) {
    global $memory;
    $memval = str_pad($memval, strlen($mask), "0", STR_PAD_LEFT);
    $memval = str_split($memval);
    $mask = str_split($mask);

    for($i = 0; $i < count($mask); $i++) {
        if($mask[$i] == "X") continue;
        if($mask[$i] == "0") $memval[$i] = "0";
        if($mask[$i] == "1") $memval[$i] = "1";
    }
    $memval = implode("", $memval);
    $memory[$memloc] = bindec($memval);
}
