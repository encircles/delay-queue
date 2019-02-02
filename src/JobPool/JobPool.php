<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 23:22
 */

namespace Encircles\JobPool;

use Encircles\MsgStruct\MsgStruct;

class JobPool
{
    private $queueKey = 'DELAY_POOL:';
    private $conn;

    public function __construct()
    {
        $this->conn = new \Redis();
        $this->conn->connect('127.0.0.1', 16379);
        $this->conn->auth('123456');
    }

    public function add(string $topic, MsgStruct $msg)
    {
        return $this->conn->hSet($this->queueKey . $topic, $msg->getId(), serialize($msg));
    }
}