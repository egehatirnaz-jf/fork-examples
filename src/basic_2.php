<?php

require __DIR__ . '/../vendor/autoload.php';
use Spatie\Fork\Fork;

$results = Fork::new()
    ->before(
        child: function () {
            echo "Child process says hi!"  . PHP_EOL;
        },
        parent: function () {
            echo "Parent process says hi!" . PHP_EOL;
        }
    )
    ->after(
        child: function (int $i) {
            echo "Child is done (#$i)" . PHP_EOL;
        },
        parent: function (int $i) {
            echo "Parent is done (#$i)" . PHP_EOL;
        }
    )
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
