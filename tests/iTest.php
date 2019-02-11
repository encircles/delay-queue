<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:00
 */

namespace tests;

use Encircles\RedisConfig;
use Encircles\DelayQueue\DelayQueue;
use Encircles\JobPool\JobPool;
use Encircles\MsgStruct\MsgStruct;
use Encircles\ReadyQueue\ReadyQueue;
use PHPUnit\Framework\TestCase;

class iTest extends TestCase
{
    public function testPush()
    {
        $config = new RedisConfig('127.0.0.1', 6379, 123456);

        // 创建消息体
        $msg = new MsgStruct([]);
        $msg->create('topic1', 1000 * 10, ['a' => '111']);

        // 压入延迟队列
        $dq = new DelayQueue($config);
        $pushRes = $dq->push($msg);
        $this->assertNotEmpty($pushRes);

        // 添加到元信息
        $pool = new JobPool($config);
        $addRes = $pool->add($msg->getTopic(), $msg);
        $this->assertNotEmpty($addRes);
    }

    /**
     * @depends testPush
     */
    public function testPop()
    {
        $config = new RedisConfig('127.0.0.1', 6379, 123456);
        $topic = 'topic1';
        $dq = new DelayQueue($config);
        $res = $dq->pop($topic);
        $this->assertFalse(empty($res));

        $rq = new ReadyQueue($config);
        foreach ($res as $re) {
            $pushRes = $rq->push($topic, $re);
            var_dump($pushRes);
            $this->assertNotEmpty($pushRes);
        }
    }

    public function testReadyPush()
    {
        $config = new RedisConfig('127.0.0.1', 6379, 123456);
        $topic = 'topic1';
        $rq = new ReadyQueue($config);
        $id = $rq->pop($topic);
        var_dump($id);
        $this->assertNotEmpty($id);

        $jp = new JobPool($config);
        $msg = $jp->get($topic, $id);
        // 获取成功后设置Pool的数据状态
        $this->assertNotEmpty($msg->getId());
        var_dump($msg->getBody());
    }
}
