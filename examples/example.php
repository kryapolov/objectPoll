#!/usr/bin/env php
<?php
require_once('lib/ObjectPool/autoload.php');

use ObjectPool\ObjectPool;
use ObjectPool\tests\traits\internalUses;
use ObjectPool\tests\stubs\ExampleOne;
use ObjectPool\tests\stubs\ExampleTwo;

$exampleOne = new ExampleOne();
$keyOfExampleOne = $exampleOne->getName();
$exampleTwo = new ExampleTwo();
$keyOfExampleTwo = $exampleTwo->getName();

$pool = new ObjectPool();

$pool->getByKeyRecursive($keyOfExampleOne);
$pool->getByKeyRecursive($keyOfExampleTwo);
$pool->getByKeyRecursive($keyOfExampleOne);
$pool->getByKeyRecursive($keyOfExampleTwo);

echo "number of objects in the pool: ".$pool->getPoolSize()."\n\r";

