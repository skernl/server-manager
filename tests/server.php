<?php
declare(strict_types=1);

use Swoole\Http\Server;

return [
    'mode' => SWOOLE_PROCESS,
    'servers' => [
        'app'   =>  'index',
        'type' => SWOOLE_SOCK_TCP,
        'host' => '0.0.0.0',
        'port' => 9501,
        'sock_type' => SWOOLE_SOCK_TCP,
        'callbacks' => [],
        'options' => [
            'enable_request_lifecycle' => false,
        ],
    ],
];