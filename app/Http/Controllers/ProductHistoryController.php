<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductHistoryRequest;
use App\Models\ProductHistory;

class ProductHistoryController extends Controller
{
    public function store(StoreProductHistoryRequest $request,$id){


        $before =  ProductHistory::where('product_id',$id)->latest('id')->first()?->after ?? 0;

        $after = 0;
        if ($request->change_type==1) {
            $after = $before + $request->change;
        }

        $data =  $request->validated() + ['product_id' =>(int) $id , 'before' => $before , 'after' => $after];
        return ProductHistory::create($data);
    }
}
