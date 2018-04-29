<?php

namespace Swoft\WebSocket\Server\Helper;

/**
 * Class WSHelper
 * @package Swoft\WebSocket\Server\Helper
 */
class WSHelper
{
    /**
     * @param int $fd
     * @param string $prefix
     * @return string (length is 32)
     * @throws \Exception
     */
    public static function generateId(int $fd, string $prefix = ''): string
    {
        // 参照 mongoDb ID: Time + Machine + PID + INC
        return $prefix .
            \date('YmdHis') .
            \hash('crc32', \php_uname()) .
            \str_pad(\dechex(\getmypid()), 4, 0, STR_PAD_LEFT) .
            \str_pad(\dechex($fd), 6, 0, STR_PAD_LEFT);
            // \dechex(\random_int(2000000, 16000000));
    }
}
