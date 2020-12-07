<?php
require_once("inputs/day7.php");
echo "Day 7, problem 2\n";

//$input = <<<EOF
//light red bags contain 1 bright white bag, 2 muted yellow bags.
//dark orange bags contain 3 bright white bags, 4 muted yellow bags.
//bright white bags contain 1 shiny gold bag.
//muted yellow bags contain 2 shiny gold bags, 9 faded blue bags.
//shiny gold bags contain 1 dark olive bag, 2 vibrant plum bags.
//dark olive bags contain 3 faded blue bags, 4 dotted black bags.
//vibrant plum bags contain 5 faded blue bags, 6 dotted black bags.
//faded blue bags contain no other bags.
//dotted black bags contain no other bags.
//EOF;


$start_time = microtime(true);
$input = str_replace(".", "", $input);
$input = str_replace("bags", "", $input);
$input = str_replace("bag", "", $input);

$rules = explode("\n", $input);
$bag_rules = [];
foreach($rules as $r) {
    $bag = explode("contain", $r);
    $bag_rules[trim($bag[0])] = [];
    $contains = explode(",", $bag[1]);
    foreach($contains as $c) {
        $tmp = explode(" ", trim($c));
        $contain_data = [ $tmp[0], trim(str_replace($tmp[0], "", $c)) ];
        $bag_rules[trim($bag[0])][] = $contain_data;
    }
}


$child_list = [];
$child_list = find_child_list("shiny gold", $child_list);
$count = find_child_count($child_list);
#var_dump($child_list);
echo "Number of bags: $count\n";

$end_time = microtime(true);
$ms_time = ($end_time - $start_time) * 1000;
echo "Time: " . number_format($ms_time, 3) . "ms\n";



function find_container($color, $container_list) {
    global $bag_rules;
    foreach($bag_rules as $outer => $rule) {
        foreach($rule as $r) {
            if($r[1] == $color) {
                $container_list[$outer] = true;
                $container_list = find_container($outer, $container_list);
            }
        }
    }
    return $container_list;
}


function find_child_list($color, $child_list) {
    global $bag_rules;
    foreach($bag_rules as $outer => $rule) {
        if($color != $outer) continue;
        $count = 0;
        foreach($rule as $r) {
            $children = find_child_list($r[1], []);
            if(count($children)) {
                $subdata = array_merge($r, [ "children" => $children]);
            } else {
                $subdata = $r;
            }
            $child_list[$count] = $subdata;
            $count++;
        }
    }

    return $child_list;
}

function find_child_count($list, $times = 1) {
    $count = 0;
    foreach($list as $l) {
        #echo "Found $times {$l[1]} bags\n";
        $count += intval($l[0])*$times;
        if(isset($l["children"]) && $l["children"][0][0] != "no") {
            $count += ($times * find_child_count($l["children"], $l[0]));
        }
    }
    return $count;
}
