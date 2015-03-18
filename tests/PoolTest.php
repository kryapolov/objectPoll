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
class PoolTest extends \PHPUnit_Framework_TestCase
{

    const MAX_POLL_SIZE = 149;
    const EXAMPLE_KEY = 'ObjectPool\tests\stubs\ExampleOne';


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

    /**
     * default realisation class builer
     */
    public function testConstructByKey()
    {

        if (!class_exists($this::EXAMPLE_KEY)) {
            //WTF
        }

        $pool = new ObjectPool();
        $constructed = $pool->constructByKey($this::EXAMPLE_KEY);

        $this->assertEquals(true, is_a($constructed, $this::EXAMPLE_KEY));

    }


    /**
     * check overflow limit filter
     */
    public function testCheckingOfSizeRestrictions()
    {


        $pool = new ObjectPool();

        $exampleOne = new ExampleOne();
        $keyOfExampleOne = $exampleOne->getName();

        $exampleTwo = new ExampleTwo();
        $keyOfExampleTwo = $exampleTwo->getName();

        $pool->setMaxPoolSize(1);

        $pool->getByKeyRecursive($keyOfExampleOne);
        $pool->getByKeyRecursive($keyOfExampleTwo);

        $pollSizeAftherOverflow = $pool->getPoolSize();

        $this->assertEquals(1, $pollSizeAftherOverflow);

    }

    /**
     * check all get method return correct set object
     */
    public function testGetByKeys()
    {

        $pool = new ObjectPool();

        $exampleOne = new ExampleOne();
        $keyOfExampleOne = $exampleOne->getName();

        $checkOne = $pool->getByKeyRecursive($keyOfExampleOne);
        $checkTwo = $pool->getByKey($keyOfExampleOne);

        $this->assertEquals($exampleOne, $checkOne);
        $this->assertEquals($exampleOne, $checkTwo);

    }

    /**
     * check simple setByKey to Pool
     */
    public function testSetToPool()
    {

        $pool = new ObjectPool();

        $exampleOne = new ExampleOne();
        $keyOfExampleOne = $exampleOne->getName();

        $pool->setToPool($keyOfExampleOne, $exampleOne);

        $checkOne = $pool->getByKeyRecursive($keyOfExampleOne);
        $checkTwo = $pool->getByKey($keyOfExampleOne);

        $this->assertEquals($exampleOne, $checkOne);
        $this->assertEquals($exampleOne, $checkTwo);
    }


    /**
     * check correct remove value by key
     */
    public function testEraseByKey()
    {
        $pool = new ObjectPool();

        $exampleOne = new ExampleOne();
        $keyOfExampleOne = $exampleOne->getName();

        $pool->setToPool($keyOfExampleOne, $exampleOne);

        $checkOne = $pool->getByKey($keyOfExampleOne);

        $pool->eraseByKey($keyOfExampleOne);


        $this->assertEquals($exampleOne, $checkOne);
        $this->assertEquals(0, $pool->getPoolSize());

    }


}
