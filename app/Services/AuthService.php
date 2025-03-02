<?php

namespace App\Services;

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class AuthService
{
    public function __construct(
        public RedisService $redisService
    ) {}

    public function session()
    {
        return $this->redisService->get(request()->bearerToken());
    }

    public function login($request)
    {
        if (Redis::exists($request->email)) {
            $user = $this->redisService->get($request->email);
            if (Hash::check($request->password, $user['password'])) {
                $token = $this->getToken();
                $user['type'] = 'session';
                Redis::setex($token, env('TOKEN_TIME', 300), collect($user)->except('password'));

                return $token;
            }
        }
        throw new LoginException;
    }

    protected function getToken(): string
    {
        return Str::uuid()->toString().Str::random(120);
    }
}
