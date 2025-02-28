<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function success($data = null)
    {
        return response()->json($data);
    }

    public function fail($data = null, $statusCode = 400)
    {
        return response()->json($data, $statusCode);
    }
}
