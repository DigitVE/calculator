<?php

require __DIR__ . '/vendor/autoload.php';

$expression = new \App\Calculator\Expression();
$expression->setExpression($argv[1]);
$expression->perform();

echo 'Выражение будет равно: ' . $expression->getResult() . PHP_EOL;