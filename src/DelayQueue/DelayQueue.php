<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:17
 */

namespace Encircles\DelayQueue;


use Encircles\MsgStruct\MsgStruct;

class DelayQueue
{
    private $queueKey = 'DELAY_BUCKET:';
    private $conn;

    public function __construct()
    {
        $this->conn = new \Redis();
        $this->conn->connect('127.0.0.1', 6379);
        $this->conn->auth('123456');
    }

    public function push(MsgStruct $msg)
    {
        $this->conn->zAdd($this->queueKey . $msg->getTopic(), $msg->getDelay(), $msg->getId());
    }

    public function pop(string $topic)
    {
        $res = $this->conn->zRangeByScore($this->queueKey . $topic, 0, microtime(true) * 1000);
        return $res;
    }
}