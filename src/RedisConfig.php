<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/2/11
 * Time: 21:34
 */

namespace Encircles;


class RedisConfig
{
    private $host;
    private $port;
    private $auth;

    /**
     * RedisConfig constructor.
     * @param $host
     * @param $port
     * @param $auth
     */
    public function __construct($host, $port, $auth)
    {
        $this->host = $host;
        $this->port = $port;
        $this->auth = $auth;
    }

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return mixed
     */
    public function getAuth()
    {
        return $this->auth;
    }


}