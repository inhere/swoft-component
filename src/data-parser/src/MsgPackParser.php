<?php

namespace Swoft\DataParser;

/**
 * Class MsgPackParser
 * @package Swoft\DataParser
 * @author inhere <in.798@qq.com>
 * @link https://github.com/msgpack/msgpack-php php-ext
 * @link https://github.com/rybakit/msgpack.php php
 */
class MsgPackParser extends AbstractDataParser
{
    /**
     * class constructor.
     * @throws \RuntimeException
     */
    public function __construct()
    {
        if (!\function_exists('msgpack_pack')) {
            throw new \RuntimeException("The php extension 'msgpack' is required!");
        }

        parent::__construct();
    }

    /**
     * @param mixed $data
     * @return string
     */
    public function encode($data): string
    {
        return \msgpack_pack($data);
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function decode(string $data)
    {
        return \msgpack_unpack($data);
    }
}
