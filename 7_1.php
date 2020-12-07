<?php
require_once("inputs/day7.php");
echo "Day 7, problem 1\n";

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

$container_list = [];
$container_list = find_container("shiny gold", $container_list);
#var_dump($container_list);
echo "Number of bags: " . count($container_list) . "\n";

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
