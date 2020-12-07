<?php
require_once("inputs/day6.php");
echo "Day 6, problem 1\n";

$start_time = microtime(true);
$answer_sets = explode("\n\n", $input);

$ac = 0;
array_map(function($a) { global $ac; $ac += count(array_unique(str_split(str_replace("\n", "", $a)))); }, $answer_sets);
echo "Number of answers: $ac\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";