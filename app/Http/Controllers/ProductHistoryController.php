<?php

namespace App\Http\Controllers;

use App\Enums\ProductHistoryDescriptionEnum;
use App\Http\Requests\StoreProductHistoryRequest;
use App\Http\Requests\UpdateProductHistoryRequest;
use App\Http\Resources\ProductHistoryResource;
use App\Models\ProductHistory;
use App\Services\Elastic\ProductHistoryElastic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductHistoryController extends Controller
{


    /**
     * @param ProductHistoryElastic $productHistoryElastic
     */
    public function __construct(
        public ProductHistoryElastic $productHistoryElastic,
    )
    {
        DB::beginTransaction();
    }


    /**
     * @param $product
     * @return JsonResponse
     */
    public function index($product): JsonResponse
    {
        try {
            $where['body']['query']['bool']['must']['term'] = ['product_id' => $product];
            return $this->success($this->productHistoryElastic->search($where));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    public function store(StoreProductHistoryRequest $request, $id)
    {
        try {
            $before = ProductHistory::where('product_id', $id)->latest('id')->first()?->after ?? 0;
            $after = match ($request->change_type) {
                ProductHistoryDescriptionEnum::URUN_EKLENDI->value, ProductHistoryDescriptionEnum::GERI_DONUSUMDEN_URUN_EKLENDI->value => $before + $request->change,
                default => $before - $request->change,
            };

            $data = $request->validated() + ['product_id' => (int)$id, 'before' => $before, 'after' => $after];
            return $this->success(ProductHistoryResource::make(ProductHistory::create($data)));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    public function update(UpdateProductHistoryRequest $request, $product_id)
    {

        return $product_id;

        $before = ProductHistory::where('id', '<', 3)->latest('id')->first();


        return $before;
    }
}
