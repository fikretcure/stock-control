<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\Elastic\ProductElastic;

class ProductController extends Controller
{
    /**
     * @param ProductElastic $productElastic
     */
    public function __construct(
        public ProductElastic $productElastic,
    ){

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success($this->productElastic->search());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $products = Product::create($request->validated());
        $this->productElastic->store($products);
        return $this->success($products);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return $this->success($this->productElastic->show($product));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());
        $this->productElastic->update($product->refresh());
        return $this->success($product->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        $this->productElastic->update($product->refresh());
        return $this->success($product->refresh());
    }
}
