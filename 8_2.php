<?php
require_once("inputs/day8.php");
echo "Day 8, problem 2\n";

$start_time = microtime(true);
$input = explode("\n", $input);
$ops = array_map(function($x) { $tmp = explode(" ", $x); return [ $tmp[0], intval($tmp[1])]; },$input);

$accumulator = 0;
reset_state();

$check = false;
foreach($ops as $i => $op) {
    $op_copy = $ops;
    reset_state();
    if($op[0] == "nop") {
        $op_copy[$i] = [ "jmp", $op[1] ];
        if($check = run_program($op_copy)) {
            echo "Successful nop -> jmp on line $i\n";
            break;
        }
    }
}

if(!$check) {

    foreach($ops as $i => $op) {
        $op_copy = $ops;
        reset_state();
        if($op[0] == "jmp") {
            $op_copy[$i] = [ "nop", $op[1] ];
            if($check = run_program($op_copy)) {
                echo "Successful jmp -> nop on line $i\n";
                break;
            }
        }
    }


}

if(!$check) {
    echo "Unable to run a successful program\n";
}


echo "Accumulator: $accumulator\n";
$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";


function reset_state() {
    global $accumulator;

    $accumulator = 0;
}

function run_program($ops) {
    $op_pointer = 0;
    $op_stack = [];
    global $accumulator;

    $success = true;
    while($op_pointer < count($ops)) {
        // Infinite loop detection
        if(count($op_stack) > count($ops)) {
            $success = false;
            break;
        }
        $op_stack[] = $op_pointer;
        switch($ops[$op_pointer][0]) {
            case "nop":
                $op_pointer++;
                break;
            case "acc":
                $accumulator += $ops[$op_pointer][1];
                $op_pointer++;
                break;
            case "jmp":
                $op_pointer += $ops[$op_pointer][1];
                break;
        }
    }

    return $success;
}