<?php
/**
 * Created by PhpStorm.
 * User: encircles
 * Date: 2019/1/25
 * Time: 17:16
 */

namespace Encircles\MsgStruct;


use Encircles\SnowFlake\SnowFlake;

class MsgStruct
{
    /*topic*/
    private $topic;
    /*全局唯一 snowflake*/
    private $id;
    /*bizKey*/
    private $bizKey;
    /*延时毫秒数*/
    private $delay;
    /*优先级*/
    private $priority;
    /*消费端消费的ttl*/
    private $ttl;
    /*消息体*/
    private $body;
    /*创建时间*/
    private $createTime;
    /*状态*/
    private $status;
    /*配置*/
    private $config = [];

    /**
     * MsgStruct constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function create($topic, $delay, $ttl, $body, $priority = 0)
    {
        try {

            $this->id = (new SnowFlake(0, 0))->generateID();
            $this->topic = $topic;
            $this->delay = $delay;
            $this->ttl = $ttl;
            $this->body = $body;
            $this->priority = $priority;
            $this->createTime = $this->getUnixTimestamp();
            $this->status = 0;

        } catch (\Exception $e) {
        }

    }

    public static function encode()
    {

    }

    public static function decode()
    {

    }

    private function getUnixTimestamp()
    {
        return floor(microtime(true) * 1000);
    }
}