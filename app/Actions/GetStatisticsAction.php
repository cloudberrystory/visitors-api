<?php

namespace App\Actions;

use App\Storages\CounterStorage;

class GetStatisticsAction
{

    public function __construct(
        protected CounterStorage $storage,
    ) {
    }

    public function handle(): array
    {
        return $this->storage->all(CounterStorage::KEY_COUNTRIES);
    }
}