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
    /*消费端消费的ttl 超时时间 ms*/
    private $ttl = 30000;
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

    public function create($topic, $delay, $body, $priority = 0)
    {
        try {
            $timestamp = $this->getUnixTimestamp();
            $this->id = SnowFlake::make(0, 0);
            $this->topic = $topic;
            $this->delay = $timestamp + $delay;
            $this->body = $body;
            $this->priority = $priority;
            $this->createTime = $timestamp;
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

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getBizKey()
    {
        return $this->bizKey;
    }

    /**
     * @return mixed
     */
    public function getDelay()
    {
        return $this->delay;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }


}