<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:59
 */

namespace Encircles\ReadyQueue;


use Encircles\MsgStruct\MsgStruct;

class ReadyQueue
{
    private $queueKey = 'DELAY_READY:';
    private $conn;

    public function __construct()
    {
        $this->conn = new \Redis();
        $this->conn->connect('127.0.0.1', 6379);
        $this->conn->auth('123456');
    }

    public function push(MsgStruct $msg)
    {
        $this->conn->lPush($this->queueKey . $msg->getTopic(), $msg->getTtl(), serialize($msg));
    }

    public function pop()
    {
        $res = $this->conn->zRangeByScore($this->queueKey, 0, microtime(true) * 1000);
        return $res;
    }
}