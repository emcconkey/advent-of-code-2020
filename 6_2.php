<?php
require_once("inputs/day6.php");
echo "Day 6, problem 2\n";

$start_time = microtime(true);
$answer_sets = explode("\n\n", $input);

$answer_count = 0;

foreach($answer_sets as $a) {
    $person_answer_sets = explode("\n", $a);
    $person_count = count($person_answer_sets);
    $group_answer_set = [];
    $person_number = 0;
    foreach($person_answer_sets as $p) {
        $person_number++;
        $person_answers = str_split($p);
        foreach($person_answers as $pa) {
            if (!isset($group_answer_set[$pa])) $group_answer_set[$pa] = 0;
            $group_answer_set[$pa]++;
        }
    }
    foreach($group_answer_set as $ga) {
        if($ga == $person_count) $answer_count++;
    }
}

echo "Number of answers: $answer_count\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";