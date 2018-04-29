# websocket

## 关于 fd

- `fd` 是TCP客户端连接的标识符，在Server程序中是唯一的
- `fd` 是一个自增数字，范围是1 ～ 1600万，`fd`超过1600万后会自动从1开始进行复用
- `fd` 是复用的，当连接关闭后`fd`会被新进入的连接复用


## simple handshake

```php
    /**
     * @param Request $request
     * @param Response $response
     * @return bool
     */
    protected function simpleHandshake(Request $request, Response $response): bool
    {
        $this->log("received handshake request from fd #{$request->fd}, co ID #" . Coroutine::tid());

        // websocket握手连接算法验证
        $secWSKey = $request->header['sec-websocket-key'];

        if (WebSocket::isInvalidSecWSKey($secWSKey)) {
            $response->end();

            return false;
        }

        $headers = WebSocket::handshakeHeaders($secWSKey);

        // WebSocket connection to 'ws://127.0.0.1:9502/'
        // failed: Error during WebSocket handshake:
        // Response must not include 'Sec-WebSocket-Protocol' header if not present in request: websocket
        if (isset($request->header['sec-websocket-protocol'])) {
            $headers['Sec-WebSocket-Protocol'] = $request->header['sec-websocket-protocol'];
        }

        foreach ($headers as $key => $val) {
            $response->header($key, $val);
        }

        $response->status(101);
        $response->end();

        return true;
    }
```
