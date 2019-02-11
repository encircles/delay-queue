<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:59
 */

namespace Encircles\ReadyQueue;


use Encircles\RedisConfig;
use Encircles\MsgStruct\MsgStruct;

class ReadyQueue
{
    private $queueKey = 'DELAY_READY:';
    private $conn;

    public function __construct(RedisConfig $config)
    {
        $this->conn = new \Redis();
        $this->conn->connect($config->getHost(), $config->getPort());
        $this->conn->auth($config->getAuth());
    }

    public function push(string $topic, string $id)
    {
        return $this->conn->lPush($this->queueKey . $topic, $id);
    }

    public function pop(string $topic)
    {
        return $this->conn->rPop($this->queueKey . $topic);
    }
}