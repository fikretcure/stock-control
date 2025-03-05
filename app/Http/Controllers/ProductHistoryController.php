<?php

namespace App\Http\Controllers;

use App\Enums\ProductHistoryDescriptionEnum;
use App\Http\Requests\StoreProductHistoryRequest;
use App\Models\ProductHistory;

class ProductHistoryController extends Controller
{
    public function store(StoreProductHistoryRequest $request,$id){
        $before =  ProductHistory::where('product_id',$id)->latest('id')->first()?->after ?? 0;
        $after = 0;
        switch ($request->change_type) {
            case ProductHistoryDescriptionEnum::URUN_EKLENDI->value:
                $after = $before + $request->change;
                break;
            default:
                $after = $before - $request->change;
                break;
        }

        $data =  $request->validated() + ['product_id' =>(int) $id , 'before' => $before , 'after' => $after];
        return ProductHistory::create($data);
    }
}
