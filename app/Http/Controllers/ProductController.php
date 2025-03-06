<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Elastic\ProductElastic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductController extends Controller
{
    /**
     * @param ProductElastic $productElastic
     */
    public function __construct(
        public ProductElastic $productElastic,
    ){
        DB::beginTransaction();
    }



    /**
     * @return JsonResponse
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(): JsonResponse
    {
        try {
            return $this->success($this->productElastic->search());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    /**
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $products = Product::create($request->validated());
            return $this->success(ProductResource::make($products));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param $products
     * @return JsonResponse
     */
    public function show($products): JsonResponse
    {
        try {
            return $this->success($this->productElastic->show($products));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, Product $product): JsonResponse
    {
        try {
            $product->update($request->validated());
            return $this->success(ProductResource::make($product->refresh()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }



    /**
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            return $this->success(ProductResource::make($product->refresh()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }
}
