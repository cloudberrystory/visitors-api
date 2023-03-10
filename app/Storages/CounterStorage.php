<?php

namespace App\Storages;

interface CounterStorage
{
    public const KEY_COUNTRIES = 'countries';

    public function all(string $key): array;

    public function increment(string $key, string $name, int $value = 1): int;
}