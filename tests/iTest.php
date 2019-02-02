<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:00
 */

namespace tests;

use Encircles\DelayQueue\DelayQueue;
use Encircles\JobPool\JobPool;
use Encircles\MsgStruct\MsgStruct;
use Encircles\ReadyQueue\ReadyQueue;
use PHPUnit\Framework\TestCase;

class iTest extends TestCase
{
    public function testPush()
    {
        // 创建消息体
        $msg = new MsgStruct([]);
        $msg->create('topic1', 1000 * 10, ['a' => '111']);

        // 压入延迟队列
        $dq = new DelayQueue();
        $pushRes = $dq->push($msg);
        $this->assertNotEmpty($pushRes);

        // 添加到元信息
        $pool = new JobPool();
        $addRes = $pool->add($msg->getTopic(), $msg);
        $this->assertNotEmpty($addRes);
    }

    /**
     * @depends testPush
     */
    public function testPop()
    {
        $topic = 'topic1';
        $dq = new DelayQueue();
        $res = $dq->pop($topic);
        $this->assertFalse(empty($res));

        $rq = new ReadyQueue();
        foreach ($res as $re) {
            $pushRes = $rq->push($topic, $re);
            var_dump($pushRes);
            $this->assertNotEmpty($pushRes);
        }
    }

//    public function testReadyPush()
//    {
//
//    }
}
