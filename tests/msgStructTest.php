<?php
/**
 * Created by PhpStorm.
 * User: encir
 * Date: 2019/1/30
 * Time: 22:01
 */

namespace tests;

use Encircles\MsgStruct\MsgStruct;
use PHPUnit\Framework\TestCase;

class msgStructTest extends TestCase
{
    public function testCreate()
    {
        $msg = new MsgStruct([]);
        $msg->create('topic1', 1000 * 10, json_encode(['a' => 111]));
        var_dump($msg->getId());
        $this->assertNotEmpty($msg->getId());
    }
}
