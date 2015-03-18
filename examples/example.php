#!/usr/bin/env php
<?php
require_once('lib/ObjectPool/autoload.php');

use ObjectPool\ObjectPool;
use ObjectPool\tests\traits\internalUses;

class A101
{

    use internalUses;

    private $name;

    public function __construct()
    {
        $this->name = __CLASS__;
    }

}

class A102
{
    private $name;
    use internalUses;

    public function __construct()
    {
        $this->name = __CLASS__;
    }

}


$pool = new ObjectPool();

$pool->getByKeyRecursive("A101");
$pool->getByKeyRecursive("A102");
$pool->getByKeyRecursive("A101");
$pool->getByKeyRecursive("A102");

echo "number of objects in the pool: ".$pool->getPoolSize()."\n\r";

