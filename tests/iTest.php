<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:00
 */

namespace tests;

use Encircles\DelayQueue\DelayQueue;
use Encircles\MsgStruct\MsgStruct;
use PHPUnit\Framework\TestCase;

class iTest extends TestCase
{
    public function testOne()
    {
        $msg = new MsgStruct([]);
        $msg->create('topic1', 1000 * 10, ['a' => '111']);
        $dq = new DelayQueue();
        $dq->push($msg);
        $res = $dq->pop($msg->getTopic());
        var_dump($res);
        $this->assertNotEmpty($res);
    }
}
