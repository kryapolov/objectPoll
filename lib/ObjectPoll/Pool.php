<?php

namespace ObjectPoll;

/**
 * Class Pool
 *
 * @author	Konstantin Ryapolov <kryapolov@yandex.ru>
 * @package ExtProcs
 */
interface Pool {

    /**
     * @return mixed
     */
    public function getPool();

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getByKey($key);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function getByKeyRecursive($key);

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function setToPool($key, $value);

    /**
     * @param $key
     *
     * @return mixed
     */
    public function eraseByKey($key);

    /**
     * @param $size
     *
     * @return mixed
     */
    public function setMaxPoolSize($size);

    /**
     * @return mixed
     */
    public function getMaxPoolSize();

    /**
     * @return mixed
     */
    public function getPoolSize();
}

?>
