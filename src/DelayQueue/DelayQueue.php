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
        $this->conn->connect('127.0.0.1', 16379);
        $this->conn->auth('123456');
    }

    public function push(MsgStruct $msg)
    {
        return $this->conn->zAdd($this->queueKey . $msg->getTopic(), $msg->getDelay(), $msg->getId());
    }

    public function pop(string $topic)
    {
        $now = microtime(true) * 1000;
        $res = $this->conn->zRangeByScore($this->queueKey . $topic, 0, $now);
        $this->conn->zDeleteRangeByScore($this->queueKey . $topic, 0, $now);
        return $res;
    }
}