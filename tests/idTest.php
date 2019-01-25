<?php
/**
 * Created by PhpStorm.
 * User: encircles
 * Date: 2019/1/25
 * Time: 17:08
 */

namespace tests;


use Encircles\SnowFlake\SnowFlake;
use PHPUnit\Framework\TestCase;

class idTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testGenerateID()
    {
        try {
            $snow = new SnowFlake(0, 0);
            $this->assertNotEmpty($snow->generateID());
        } catch (\Exception $e) {
            throw new \Exception('exception');
        }
    }
}