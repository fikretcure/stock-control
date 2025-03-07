<?php

namespace App\Http\Controllers;

use App\Enums\ProductHistoryDescriptionEnum;
use App\Http\Requests\StoreProductHistoryRequest;
use App\Http\Resources\ProductHistoryResource;
use App\Models\ProductHistory;
use Illuminate\Http\JsonResponse;

class ProductHistoryController extends Controller
{

    public function index($id)
    {
        return ProductHistoryResource::collection(ProductHistory::query()->where('product_id', $id)->get());
    }


    public function store(StoreProductHistoryRequest $request, $id)
    {
        $before = ProductHistory::where('product_id', $id)->latest('id')->first()?->after ?? 0;
        $after = match ($request->change_type) {
            ProductHistoryDescriptionEnum::URUN_EKLENDI->value, ProductHistoryDescriptionEnum::GERI_DONUSUMDEN_URUN_EKLENDI->value => $before + $request->change,
            default => $before - $request->change,
        };

        $data = $request->validated() + ['product_id' => (int)$id, 'before' => $before, 'after' => $after];
        $product_history = ProductHistory::create($data);
        return ProductHistoryResource::make($product_history);
    }
}
