<?php


namespace ObjectPool\tests\stubs;
use ObjectPool\tests\traits\internalUses;

/**
 * Class A101
 *
 * @package ObjectPool\tests\stub
 */
class ExampleOne {
    private $name;
    use internalUses;

    public function __construct()
    {
        $this->name = __CLASS__;
    }
}