<?php

require __DIR__ . '/../vendor/autoload.php';
use Spatie\Fork\Fork;

$results = Fork::new()
    ->run(
        function () {
            sleep(2);
            echo "Second echo!" . PHP_EOL;
            return 1;
        },
        function () {
            sleep(1);
            echo "First echo!" . PHP_EOL;
            return 2;
        },
        function () {
            sleep(3);
            echo "Third echo!" . PHP_EOL;
            return 3;
        }
    );

foreach ($results as $result) {
    echo $result  . PHP_EOL;
}
