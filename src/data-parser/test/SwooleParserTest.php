<?php

namespace SwoftTest\DataParser;

use Swoft\DataParser\SwooleParser;
use PHPUnit\Framework\TestCase;
use Swoole\Serialize;

/**
 * Class SwooleParserTest
 * @covers SwooleParser
 */
class SwooleParserTest extends TestCase
{
    public function testEncode()
    {
        if (!\class_exists(Serialize::class, false)) {
            return;
        }

        $data = [
            'name' => 'value',
        ];

        $parser = new SwooleParser();
        $ret = $parser->encode($data);

        $this->assertInternalType('string', $ret);
    }

    public function testDecode()
    {
        if (!\class_exists(Serialize::class, false)) {
            return;
        }

        $data = [
            'name' => 'value',
        ];

        $parser = new SwooleParser();
        $str = $parser->encode($data);
        $ret = $parser->decode($str);

        $this->assertInternalType('array', $ret);
        $this->assertArrayHasKey('name', $ret);
    }

}
