<?php

use Swoft\WebSocket\Server\SocketIO\SocketIO;

if (!function_exists('sio')) {
    /**
     * @param int|null $fd
     * @return SocketIO
     */
    function sio(int $fd = null): SocketIO
    {
        return new SocketIO($fd);
    }
}
