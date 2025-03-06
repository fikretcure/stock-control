<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

abstract class Controller
{
    public function success($data = null)
    {
        DB::commit();
        return response()->json($data);
    }

    public function fail($data = null, $statusCode = 400)
    {
        DB::rollBack();
        return response()->json($data, $statusCode);
    }
}
