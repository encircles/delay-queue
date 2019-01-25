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
    /**
     * @throws \Exception
     */
    public function testGenerateID()
    {
        $snow = new SnowFlake(1, 1);
        $id = $snow->generateID();
        $this->assertNotEmpty($id);
    }
}