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

$randArr = [97, 26, 75, 29, 4, 51, 60, 81, 69, 86];

// We need as many functions as our elements in randArr.
$sleeperFunctions = array_map(function ($element) {
    return fn() => zzz($element);
}, $randArr);

$curTime = microtime(true);
$results = Fork::new()
    ->run(
        ...($sleeperFunctions)
    );
$timeConsumed = round(microtime(true) - $curTime, 3) * 1000;

echo "Sorted array is: " . json_encode(array_values($results)) . PHP_EOL;
echo "Elapsed time in ms: " . $timeConsumed . PHP_EOL;
echo "Non-parallel sleepsort would take " . array_sum($randArr) . "+ ms.";
