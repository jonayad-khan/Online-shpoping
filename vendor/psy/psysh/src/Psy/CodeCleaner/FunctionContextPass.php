<?php

namespace Illuminate\Redis\Connections;

use Redis;
use Closure;

/**
 * @mixin \Redis
 */
class PhpRedisConnection extends Connection
{
    /**
     * Create a new PhpRedis connection.
     *
     * @param  \Redis  $client
     * @return void
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Returns the value of the given key.
     *
     * @param  string  $key
     * @return string|null
     */
    public function get($key)
    {
        $result = $this->client->get($key);

        return $result !== false ? $result : null;
    }

    /**
     * Get the values of all the given keys.
     *
     * @param  array  $keys
     * @return array
     */
    public function mget(array $keys)
    {
        return array_map(function ($value) {
            return $value !== false ? $value : null;
        }, $this->client->mget($keys));
    }

    /**
     * Determine if the given keys exist.
     *
     * @param  dynamic  $key
     * @return int
     */
    public function exists(...$keys)
    {
        $keys = collect($keys)->map(function ($key) {
            return $this->applyPrefix($key);
        })->all();

        return $this->executeRaw(array_merge(['exists'], $keys));
    }

    /**
     * Set the string value in argument as value of the key.
     *
   