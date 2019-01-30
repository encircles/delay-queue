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
use SebastianBergmann\CodeCoverage\Report\PHP;

class idTest extends TestCase
{
    public function testGenerateID()
    {
        $this->assertFalse(false);
    }

    /**
     * @depends testGenerateID
     */
//    public function testSecond(string $key1)
//    {
//        $this->assertNotEmpty($key1);
//        $key1 = 'bbb';
//        return $key1;
//    }

    /**
     * @param string $key1
     * @return string
     * @depends testGenerateID
     */
//    public function testThird(string $key1)
//    {
//        $this->assertContains('a', $key1);
//        return $key1;
//    }

}