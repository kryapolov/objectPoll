<?php

namespace ObjectPoll;

/**
 * Class ObjectPool
 *
 * @author	Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package ObjectPoll
 */
class ObjectPool implements Pool
{

    /**
     * @var    array
     */
    public $pool = array();

    /**
     * @var    int
     */
    private $maxPoolSize = 100;

    /**
     * @return $this|mixed
     */
    public function getPool()
    {
        return $this;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getByKey($key)
    {
        return $this->pool[$key];
    }

    /**
     * function for be replaced
     *
     * @param $key
     *
     * @return mixed
     */
    public function constructByKey($key)
    {
        return new $key;
    }

    /**
     * method is able to build a facility for the requested key
     *
     * @param $key
     *
     * @return mixed|void
     * @throws \ErrorException
     */
    public function getByKeyRecursive($key)
    {

        if (!array_key_exists($key, $this->pool)) {

            if (class_exists($key)) {

                // remove an object if the pull scored
                if (count($this->pool) >= $this->getMaxPoolSize()) {
                    array_shift($this->pool);
                }

                $this->pool[$key] = $this->constructByKey($key);

            } else {
                throw new \ErrorException("Target Object not be construct!");
            }
        }
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return mixed|void
     */
    public function setToPool($key, $value)
    {
        $this->pool[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return mixed|void
     */
    public function eraseByKey($key)
    {
        unset($this->pool[$key]);
    }

    /**
     * @param int $size
     *
     * @return mixed|void
     */
    public function setMaxPoolSize($size)
    {
        $this->maxPoolSize = $size;
    }

    /**
     * @return int|mixed
     */
    public function getMaxPoolSize()
    {
        return $this->maxPoolSize;
    }

    /**
     * @return int|mixed
     */
    public function getPoolSize()
    {
        return count($this->pool);
    }

}