#!/usr/bin/env php
<?php

use Swoole\Process\Manager;

//ini_set('display_errors', 'on');
//ini_set('display_startup_errors', 'on');
//ini_set('memory_limit', '1G');
//
//error_reporting(E_ALL);
//
//!defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__));
//
//require BASE_PATH . '/vendor/autoload.php';

echo 1;
$http = new Swoole\Http\Server(
    '0.0.0.0',
    80,
    SWOOLE_PROCESS,
    SWOOLE_SOCK_TCP,
);

$http->set([
    'daemonize' => false
]);

$http->on('start', function ($server) {
    var_dump($server->master_pid);
});

$http->on('Request', function (
    \Swoole\Http\Request $request,
                         $response
) {

    var_dump($request->header);


    $response->header('Content-Type', 'text/html; charset=utf-8');
    $response->end(<<<EOF

        你好

        EOF
    );
});

$http->on('packet', function ($server, $fd) {
    echo "client {$fd} closed\n";
});


//$ws = new Swoole\Server(
//    '0.0.0.0',
//    8080,
//    SWOOLE_PROCESS,
//    SWOOLE_SOCK_TCP,
//);

$ws = $http->addlistener(
    '0.0.0.0',
    8080,
    SWOOLE_SOCK_TCP,
);

$ws = $http->listen(
    '0.0.0.0',
    8080,
    SWOOLE_SOCK_TCP,
);

$ws->set([
    'open_websocket_protocol' => true,
]);

//$ws->on('start', function ($server) {
//    var_dump($server->master_pid);
//});

/**
 * @var $server \Swoole\WebSocket\Server
 */
$ws->on('open', function ($server, $request) {
    var_dump($server->getWorkerId());
    echo "server: handshake success with fd{$request->fd}\n";
});

$ws->on('Receive', function ($server, $fd, $from_id, $data) {
    // 处理接收到的数据
    $server->send($fd, "Server: $data");
});

$ws->on('message', function ($server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    $server->push($frame->fd, "this is server");
});

$ws->on('close', function ($server, $fd) {
    echo "client {$fd} closed\n";
});

$http->start();