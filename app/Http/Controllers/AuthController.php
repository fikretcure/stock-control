<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthLoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(
        public AuthService $authService
    ) {}

    public function login(AuthLoginRequest $request)
    {
        return $this->success($this->authService->login($request));
    }

    public function session()
    {
        return $this->success($this->authService->session());
    }
}
