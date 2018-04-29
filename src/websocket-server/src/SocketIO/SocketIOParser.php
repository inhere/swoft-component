<?php

namespace Swoft\WebSocket\Server\SocketIO;

use Swoft\DataParser\AbstractDataParser;
use Swoft\Helper\JsonHelper;

/**
 * Class SocketIOParser
 * @package Swoft\WebSocket\Server\SocketIO
 */
class SocketIOParser extends AbstractDataParser
{
    const STRUCTURE = [
        'id' => 0,
        'type' => '',
        'data' => []
    ];

    /**
     * @param mixed $data
     * @return string
     */
    public function encode($data): string
    {
        $data = (array)$data;

        JsonHelper::encode($data);
    }

    /**
     * @param string $data
     * @return mixed
     */
    public function decode(string $data)
    {
        $data = \trim($data);

        // Not a json map string
        if ($data[0] !== '{') {

        }
    }
}
