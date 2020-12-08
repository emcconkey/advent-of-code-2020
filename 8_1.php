<?php
require_once("inputs/day8.php");
echo "Day 8, problem 1\n";

$start_time = microtime(true);
$ops = array_map(function($x) { $tmp = explode(" ", $x); return [ $tmp[0], intval($tmp[1])]; },explode("\n", $input));
$op_pointer = 0;
$accumulator = 0;
$op_stack = [];
while($op_pointer < count($ops)) {
    if(in_array($op_pointer, $op_stack)) {
        echo "Duplicate code detected at line $op_pointer\n";
        break;
    }
    $op_stack[] = $op_pointer;
    switch($ops[$op_pointer][0]) {
        case "nop":
            #echo "nop\n";
            $op_pointer++;
            break;
        case "acc":
            $accumulator += $ops[$op_pointer][1];
            #echo "acc " . $ops[$op_pointer][1] . " " . $accumulator . "\n";
            $op_pointer++;
            break;
        case "jmp":
            $op_pointer += $ops[$op_pointer][1];
            #echo "jmp " . $ops[$op_pointer][1] . "\n";
            break;
    }
}
echo "Accumulator: $accumulator\n";
$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";
