<?php

if (!function_exists('ws')) {
    /**
     * @return \Swoft\WebSocket\Server\WebSocketServer
     */
    function ws(): \Swoft\WebSocket\Server\WebSocketServer
    {
        return \Swoft\App::$server;
    }
}
