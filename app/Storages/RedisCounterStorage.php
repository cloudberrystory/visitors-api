<?php

namespace App\Storages;

use Illuminate\Redis\Connections\PhpRedisConnection;

class RedisCounterStorage implements CounterStorage
{

    public function __construct(
        protected PhpRedisConnection $connection,
    ) {
    }

    public function all(string $key): array
    {
        return $this->connection->hGetAll($key);
    }

    public function increment(string $key, string $name, int $value = 1): int
    {
        if ($value <= 0) {
            throw new \Exception('Value must be more than 0');
        }

        return $this->connection->hIncrBy($key, $name, $value);
    }
}