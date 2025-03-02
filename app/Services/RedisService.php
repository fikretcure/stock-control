<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{
    public function get($data)
    {
        return json_decode(Redis::get($data), true);
    }

    public function set($key, $data)
    {
        Redis::set($key, $data);
    }
}
