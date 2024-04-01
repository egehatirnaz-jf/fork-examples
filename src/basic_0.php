<?php

require __DIR__ . '/../vendor/autoload.php';

$shouldTakeBluePill = true;

$pid = pcntl_fork();

if ($pid) {
    echo "I have taken the blue pill!" . PHP_EOL;
} else {
    echo "I have taken the red pill!" . PHP_EOL;
}
