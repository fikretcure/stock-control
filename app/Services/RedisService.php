<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

/**
 *
 */
class RedisService
{
    /**
     * @param $data
     * @return mixed
     */
    public function get($data): mixed
    {
        return json_decode(Redis::get($data), true);
    }

    /**
     * @param $key
     * @param $data
     * @return void
     */
    public function set($key, $data): void
    {
        Redis::set($key, $data);
    }
}
