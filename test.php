<?php
/**
 * Created by PhpStorm.
 * User: encircles
 * Date: 2019/1/25
 * Time: 14:41
 */

require_once './vendor/autoload.php';

try {
    $snow = new \Encircles\SnowFlake\SnowFlake(1, 1);

    $conn = new \Redis();
    $conn->connect('127.0.0.1', 16379);

    for ($i = 0; $i < 100000; $i++) {
        $id = $snow->generateID();
        $conn->lPush('SNOW_ID', $id);
    }

    echo 'ok' . PHP_EOL;

//    $conn->
} catch (Exception $e) {

}