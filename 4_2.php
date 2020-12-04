<?php
require_once("inputs/day4.php");
echo "Day 4, problem 2\n";

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
    $valid_ecl = [ "amb","blu", "brn", "gry", "grn", "hzl", "oth" ];
    $passport = str_replace("\n", " ", $passport);

    foreach($required as $r) {
        if(str_contains($passport, $r)) continue;
        return false;
    }

    $pdata = explode(" ", $passport);
    foreach($pdata as $p) {
        $pairs = explode(":", $p);
        $val = $pairs[1];
        switch($pairs[0]) {
            case "byr":
                if(strlen($val) != 4) return false;
                $val = intval($val);
                if($val < 1920 || $val > 2002) return false;
                break;
            case "iyr":
                if(strlen($val) != 4) return false;
                $val = intval($val);
                if($val < 2010 || $val > 2020) return false;
                break;
            case "eyr":
                if(strlen($val) != 4) return false;
                $val = intval($val);
                if($val < 2020 || $val > 2030) return false;
                break;
            case "hgt":
                $height = intval($val);
                $units = str_replace(strval($height), "", $val);
                if($units == "cm") {
                    if($height < 150 || $height > 193) return false;
                } elseif($units == "in") {
                    if($height < 59 || $height > 76) return false;
                } else {
                    return false;
                }
                break;
            case "hcl":
                $match = "/^#([A-Fa-f0-9]{6})$/";
                if(!preg_match($match, $val)) return false;
                break;
            case "ecl":
                if(!in_array($val, $valid_ecl)) return false;
                break;
            case "pid":
                if(strlen($val) != 9) return false;
                break;
        }
    }

    return true;
}