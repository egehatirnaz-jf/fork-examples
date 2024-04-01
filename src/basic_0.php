<?php

require __DIR__ . '/../vendor/autoload.php';

$shouldTakeBluePill = true;

$shouldTakeBluePill = pcntl_fork();

if ($shouldTakeBluePill) {
    echo "I have taken the blue pill!" . PHP_EOL;
} else {
    echo "I have taken the red pill!" . PHP_EOL;
}

echo "A process has ended." . PHP_EOL;
exit();
