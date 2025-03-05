<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductHistoryRequest;

class ProductHistoryController extends Controller
{
    public function store(StoreProductHistoryRequest $request){
            return $request->validated();
    }
}
