<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 23:22
 */

namespace Encircles\JobPool;

use Encircles\RedisConfig;
use Encircles\MsgStruct\MsgStruct;

class JobPool
{
    private $queueKey = 'DELAY_POOL:';
    private $conn;

    /**
     * JobPool constructor.
     * @param RedisConfig $config
     */
    public function __construct(RedisConfig $config)
    {
        $this->conn = new \Redis();
        $this->conn->connect($config->getHost(), $config->getPort());
        $this->conn->auth($config->getAuth());
    }

    /**
     * @param string $topic
     * @param MsgStruct $msg
     * @return bool|int
     */
    public function add(string $topic, MsgStruct $msg)
    {
        return $this->conn->hSet($this->queueKey . $topic, $msg->getId(), serialize($msg));
    }

    /**
     * @param string $topic
     * @param $id
     * @return MsgStruct
     */
    public function get(string $topic, $id)
    {
        $msgStr = $this->conn->hGet($this->queueKey . $topic, $id);
        if (empty($msgStr)) {
            return (new MsgStruct([]));
        }
        return unserialize($msgStr);
    }
}