<?php
declare(strict_types=1);

namespace Skernl\ServerManger;

/**
 * @SeverInterface
 * @\Skernl\ServerManger\SeverInterface
 */
interface SeverInterface
{
    /**
     * @see SWOOLE_SOCK_TCP
     */
    public const int SERVER_HTTP = SWOOLE_SOCK_TCP;

    /**
     * @see SWOOLE_SOCK_TCP
     */
    public const int SERVER_WEBSOCKET = SWOOLE_SOCK_TCP;

    /**
     * @see SWOOLE_SOCK_UDP
     */
    public const int SERVER_UDP = SWOOLE_SOCK_UDP;

    /**
     * @see SWOOLE_UNIX_STREAM
     */
    public const int SERVER_UNIX_STREAM = SWOOLE_UNIX_STREAM;

    /**
     * @see SWOOLE_SOCK_TCP
     * @see SWOOLE_SSL
     */
    public const int SERVER_TCP_SSL = SWOOLE_SOCK_TCP | SWOOLE_SSL;
}