<?php

namespace Swoft\WebSocket\Server\SocketIO;

use Swoft\App;
use Swoft\DataParser\DataParserAwareTrait;
use Swoft\Http\Message\Server\Request;
use Swoft\WebSocket\Server\HandlerInterface;
use Swoft\WebSocket\Server\WebSocketContext;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * Class SocketIOController
 * @package Swoft\WebSocket\Server\SocketIO
 */
abstract class SocketIOController implements HandlerInterface
{
    use DataParserAwareTrait;

    /**
     * @var SocketIO
     */
    protected $io;

    /**
     * message event handlers
     * @var array
     * [
     *  'event name' => 'callback action'
     * ]
     */
    protected $events = [];

    /** @var string */
    protected $defaultEvent = 'chatMessage';

    public function init()
    {
        $this->setParser(new SocketIOParser());
        $this->configure();
    }

    protected function configure()
    {
        /*
         pingInterval: 10000,
         pingTimeout: 5000,
         */
        $this->events = [
            'chat message' => 'chatMessage'
        ];
    }

    /**
     * @param Server $server
     * @param Frame $frame
     */
    public function onMessage(Server $server, Frame $frame)
    {
        $this->dispatch($server, $frame);
    }

    /**
     * @param Server $server
     * @param Frame $frame
     */
    public function dispatch(Server $server, Frame $frame)
    {
        $parser = $this->getParser();

        $data = $parser->decode($frame->data);
    }

    public function chatMessage()
    {

    }
}
