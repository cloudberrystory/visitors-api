<?php

namespace App\Actions;


use App\Storages\CounterStorage;

class UpdateStatisticsAction
{

    public function __construct(
        protected CounterStorage $storage,
    ) {
    }

    public function handle(string $countryCode, int $value = 1): int
    {
        return $this->storage->increment(CounterStorage::KEY_COUNTRIES, $countryCode, $value);
    }
}