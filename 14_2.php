<?php
require_once("inputs/day14.php");
echo "Day 14, problem 2\n";

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

    $mask = str_split($mask);
    $memloc = str_pad(decbin($memloc), count($mask), "0", STR_PAD_LEFT);
    $oloc = $memloc;
    $memloc = str_split($memloc);

    // Set the static bits
    for($i = 0; $i < count($mask); $i++) {
        if($mask[$i] == "X") $memloc[$i] = "0";
        if($mask[$i] == "0") continue;
        if($mask[$i] == "1") $memloc[$i] = "1";
    }

    $memory[bindec(implode("",$memloc))] = $memval;

    // Set the floating bits
    apply_floating_bits($mask, $memloc, $memval, 0);

}

function apply_floating_bits($mask, $memloc, $memval, $start = 0) {
    global $memory;

    while(isset($mask[$start]) && $mask[$start] != "X") $start++;
    if(!isset($mask[$start])) return;

    $memloc[$start] = "0";
    $memory[bindec(implode("",$memloc))] = $memval;
    apply_floating_bits($mask, $memloc, $memval, $start+1);

    $memloc[$start] = "1";
    $memory[bindec(implode("",$memloc))] = $memval;
    apply_floating_bits($mask, $memloc, $memval, $start+1);

}
