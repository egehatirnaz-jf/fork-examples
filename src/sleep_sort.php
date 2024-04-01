<?php

require __DIR__ . '/../vendor/autoload.php';

use Spatie\Fork\Fork;

function zzz(int $milliseconds): int
{
    echo "I will sleep for $milliseconds ms... 😴" . PHP_EOL;
    usleep($milliseconds * 1000);
    echo "Woke up after $milliseconds ms! 🌞" . PHP_EOL;
    return $milliseconds;
}

$randArr = [970, 260, 750, 40];

// I will use 4 closures, naming these as 'sleeper functions'
$sleeperFunctions = array_map(function ($element) {
    return fn() => zzz($element);
}, $randArr);

$curTime = microtime(true);
$results = Fork::new()
    ->concurrent(count($randArr))
    ->after(
        parent: function(int $element) use (&$sortedArray){
            $sortedArray[] = $element;
        }
    )
    ->run(
        ...($sleeperFunctions)
    );
$timeConsumed = round(microtime(true) - $curTime, 3) * 1000;

echo PHP_EOL;
echo "Unsorted array is: " . json_encode($randArr) . PHP_EOL;
echo "'Sorted' array is: " . json_encode($sortedArray) . PHP_EOL;
sort($randArr);
echo "Did we sort it?: " . (array_values($sortedArray) === array_values($randArr) ? "TRUE" : "FALSE") . PHP_EOL;
echo "Elapsed time in ms: " . $timeConsumed . PHP_EOL;
echo "Non-concurrent sleepsort would take " . array_sum($randArr) . "+ ms.";
echo PHP_EOL;
