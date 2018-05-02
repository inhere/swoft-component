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

if (!function_exists('ws')) {
    /**
     * @return \Swoft\WebSocket\Server\WebSocketServer
     */
    function ws(): \Swoft\WebSocket\Server\WebSocketServer
    {
        return \Swoft\App::$server;
    }
}
