<?php

require __DIR__ . '/../vendor/autoload.php';

use Spatie\Fork\Fork;

function fire(): float
{
    $curTime = microtime(true);
    $time = round(microtime(true) - $curTime, 8);
    return $time * 1000;
}

$firetimers = [];
$results = Fork::new()
    ->run(
        function () {
            return fire();
        },
        function () {
            return fire();
        },
    );


if ($results[0] < $results[1]) {
    echo "Han Solo shot first! (Guns were drawn in " . $results[0] . " and " . $results[1] . ")";
} elseif ($results[1] < $results[0]) {
    echo "Greedo shot first! (Guns were drawn in " . $results[1] . " and " . $results[0] . ")";
} else {
    echo "Guns were drawn at the same time! " . $results[0];
}
