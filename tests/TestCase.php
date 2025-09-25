<?php

namespace ProteanCode\Cipherio\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public static function randomStringProvider(): array
    {
        $data = [];
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789 ,.!?';

        for ($i = 0; $i < 10; $i++) { // 10 random cases
            $length = rand(5, 30);
            $randomString = '';
            for ($j = 0; $j < $length; $j++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            $shift = rand(1, 25); // Caesar shift range
            $data[] = [$randomString, $shift];
        }

        return $data;
    }
}