<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginException extends Exception
{
    public function report(): void
    {
        // ...
    }

    /**
     * Render the exception into an HTTP response.
     */
    public function render(Request $request): Response
    {
        return response('Login failed.', 401);
    }
}
