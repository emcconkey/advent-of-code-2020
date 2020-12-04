<?php
require_once("inputs/day4.php");
echo "Day 4, problem 1\n";

$start_time = microtime(true);
$passports = explode("\n\n", $input);
$ptotal = 0;
$pvalid = 0;
$pinvalid = 0;

foreach($passports as $p) {
    $ptotal++;
    if(valid_passport($p)) {
        $pvalid++;
    } else {
        $pinvalid++;
    }
}


echo "Total Passports   : $ptotal\n";
echo "Valid Passports   : $pvalid\n";
echo "Invalid Passports : $pinvalid\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";


function valid_passport($passport) {
    $required = [ "byr:", "iyr:", "eyr:", "hgt:", "hcl:", "ecl:", "pid:" ];
    $passport = str_replace("\n", " ", $passport);

    foreach($required as $r) {
        if(str_contains($passport, $r)) continue;
        return false;
    }

    return true;
}