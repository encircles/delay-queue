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
        $this->conn->connect('127.0.0.1', 16379);
        $this->conn->auth('123456');
    }

    public function push(string $topic, string $id)
    {
        return $this->conn->lPush($this->queueKey . $topic, $id);
    }

    public function pop()
    {

    }
}