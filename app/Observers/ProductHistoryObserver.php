<?php

namespace App\Observers;

use App\Http\Resources\ProductHistoryResource;
use App\Models\ProductHistory;
use App\Services\Elastic\ProductHistoryElastic;

class ProductHistoryObserver
{


    public function __construct(
        public ProductHistoryElastic $productHistoryElastic,
    )
    {

    }



    /**
     * Handle the ProductHistory "created" event.
     */
    public function created(ProductHistory $productHistory): void
    {
        $productHistory = ProductHistoryResource::make($productHistory);
        $this->productHistoryElastic->storeIndex(collect($productHistory)->toArray());
    }

    /**
     * Handle the ProductHistory "updated" event.
     */
    public function updated(ProductHistory $productHistory): void
    {
        //
    }

    /**
     * Handle the ProductHistory "deleted" event.
     */
    public function deleted(ProductHistory $productHistory): void
    {
        //
    }

    /**
     * Handle the ProductHistory "restored" event.
     */
    public function restored(ProductHistory $productHistory): void
    {
        //
    }

    /**
     * Handle the ProductHistory "force deleted" event.
     */
    public function forceDeleted(ProductHistory $productHistory): void
    {
        //
    }
}
