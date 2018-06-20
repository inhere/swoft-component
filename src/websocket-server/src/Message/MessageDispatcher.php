<?php

namespace Swoft\WebSocket\Server\Message;

use Swoft\App;
use Swoft\WebSocket\Server\Exception\WsException;
use Swoole\WebSocket\Frame;

/**
 * Class MessageDispatcher
 * @package Swoft\WebSocket\Server\Message
 */
class MessageDispatcher
{
    /**
     * handlers map
     * @var array
     * handler is a method name in ws controller, or is a class implement CommandInterface
     * [
     *   'command name' => 'callback handler'
     * ]
     */
    protected $handlers = [];

    /**
     * MessageDispatcher constructor.
     * @param array $handlers
     */
    public function __construct(array $handlers = [])
    {
        $this->handlers = \array_merge($this->handlers, $handlers);
    }

    /**
     * @param object $controller
     * @param string $command
     * @param array|mixed $body
     * @param Frame $frame
     */
    public function dispatch($controller, string $command, $body, Frame $frame)
    {
        if (!$this->isCommand($command)) {
            throw new WsException("command $command is not exists", -500);
        }

        $handler = $this->handlers[$command];

        if (\is_string($handler)){
            if (\method_exists($controller, $handler)) {
                $controller->$handler($body, $frame);
                return;
            }

            if(\class_exists($handler)) {
                $obj = App::hasBean($handler) ? App::getBean($handler) : new $handler;

                if (\method_exists($obj, 'execute')) {
                    $obj->execute($body, $frame);
                    return;
                }

                $handler = $obj;
            }
        }

        if (\is_callable($handler)) {
            $handler($body, $frame);
            return;
        }

        throw new WsException("invalid message command handler for '$command'", -500);
    }

    /**
     * @param string $name
     * @return bool
     */
    public function isCommand(string $name): bool
    {
        return isset($this->handlers[$name]);
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getHandler(string $name)
    {
        return $this->handlers[$name] ?? null;
    }

    /**
     * @return array
     */
    public function getHandlers(): array
    {
        return $this->handlers;
    }

    /**
     * @param array $handlers
     */
    public function setHandlers(array $handlers)
    {
        $this->handlers = $handlers;
    }
}
