<?php

namespace Swoft\WebSocket\Server\Event\Listener;

use Swoft\App;
use Swoft\Bean\Annotation\Listener;
use Swoft\Event\AppEvent;
use Swoft\Event\EventHandlerInterface;
use Swoft\Event\EventInterface;
use Swoft\WebSocket\Server\Bean\Collector\WebSocketCollector;
use Swoft\WebSocket\Server\WebSocketServer;

/**
 * Class ApplicationLoaderListener
 * @package Swoft\WebSocket\Server\Event\Listener
 * @Listener(AppEvent::APPLICATION_LOADER)
 */
class ApplicationLoaderListener implements EventHandlerInterface
{
    /**
     * @param EventInterface $event
     */
    public function handle(EventInterface $event)
    {
        // if is ws server. collection ws routes
        if (WebSocketServer::TYPE_WS === App::$server->getServerType()) {
            /** @see \Swoft\WebSocket\Server\Router\HandlerMapping::registerRoutes() */
            \bean('wsRouter')->registerRoutes(WebSocketCollector::getCollector());
        }
    }
}
