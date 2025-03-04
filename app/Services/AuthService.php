<?php

namespace App\Services;

use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

/**
 *
 */
class AuthService
{
    /**
     * @param RedisService $redisService
     */
    public function __construct(
        public RedisService $redisService
    ) {}

    /**
     * @return mixed
     */
    public function session(): mixed
    {
        return $this->redisService->get(request()->bearerToken());
    }

    /**
     * @param $request
     * @return string
     * @throws LoginException
     */
    public function login($request): string
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

    /**
     * @return string
     */
    protected function getToken(): string
    {
        return Str::uuid()->toString().Str::random(120);
    }
}
