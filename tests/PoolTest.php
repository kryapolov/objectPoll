<?php

namespace ObjectPool\tests;
use ObjectPool\ObjectPool;
use ObjectPool\tests\stubs\ExampleOne;
use ObjectPool\tests\stubs\ExampleTwo;


/**
 * Class PoolTest
 *
 * @package ObjectPool\tests
 */
class PoolTest extends \PHPUnit_Framework_TestCase {

    const MAX_POLL_SIZE = 149;


    public function testSizeHasBeSet()
    {

        $pool = $pool = new ObjectPool();

        $pool->setMaxPoolSize($this::MAX_POLL_SIZE);
        // Act


        // Assert
        $this->assertEquals($this::MAX_POLL_SIZE, $pool->getMaxPoolSize());

    }

    /**
     * 2 write object to pull a few times and check the size of the pool
     */
    public function testGetByKeyRecursive()
    {

        $exampleOne = new ExampleOne();
        $keyOfExampleOne = $exampleOne->getName();

        $exampleTwo = new ExampleTwo();
        $keyOfExampleTwo = $exampleTwo->getName();

        $pool = new ObjectPool();

        $pool->getByKeyRecursive($keyOfExampleOne);
        $pool->getByKeyRecursive($keyOfExampleTwo);
        $firstSize = $pool->getPoolSize();

        // save dublicates to pool
        $pool->getByKeyRecursive($keyOfExampleOne);
        $pool->getByKeyRecursive($keyOfExampleTwo);

        $this->assertEquals($firstSize, $pool->getPoolSize());

    }


}
