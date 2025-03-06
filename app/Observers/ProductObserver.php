<?php

namespace App\Observers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\Elastic\ProductElastic;

class ProductObserver
{


    /**
     * @param ProductElastic $productElastic
     */
    public function __construct(
        public ProductElastic $productElastic,
    )
    {

    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Product $product): void
    {
        $product = ProductResource::make($product);
        $this->productElastic->storeIndex(collect($product)->toArray());
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Product $product): void
    {
        $product = ProductResource::make($product);
        $this->productElastic->updateIndex(collect($product)->toArray());
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Product $product): void
    {
        $product = ProductResource::make($product);
        $this->productElastic->updateIndex(collect($product)->toArray());
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
