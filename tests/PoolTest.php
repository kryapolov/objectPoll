<?php

namespace ObjectPool\tests;
use ObjectPool\ObjectPool;

/**
 * Class PoolTest
 *
 * @package ObjectPool\tests
 */
class PoolTest extends \PHPUnit_Framework_TestCase {

    const MAX_POLL_SIZE = 149;


    public function testSizeHasBeSet()
    {

        $poll = $pool = new ObjectPool();

        $poll->setMaxPoolSize($this::MAX_POLL_SIZE);
        // Act


        // Assert
        $this->assertEquals($this::MAX_POLL_SIZE, $poll->getMaxPoolSize());

    }


}
