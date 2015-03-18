<?php


namespace ObjectPool\tests\stubs;
use ObjectPool\tests\traits\internalUses;

/**
 * Class A102
 *
 * @package ObjectPool\tests\stub
 */
class ExampleTwo {
    private $name;
    use internalUses;

    public function __construct()
    {
        $this->name = __CLASS__;
    }
}