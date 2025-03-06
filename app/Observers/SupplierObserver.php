<?php

namespace App\Observers;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\Elastic\SupplierElastic;

class SupplierObserver
{


    /**
     * @param SupplierElastic $supplierElastic
     */
    public function __construct(
        public SupplierElastic $supplierElastic,
    )
    {

    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Supplier $supplier): void
    {
        $supplier = SupplierResource::make($supplier);
        $this->supplierElastic->storeIndex(collect($supplier)->toArray());
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Supplier $supplier): void
    {
        $supplier = SupplierResource::make($supplier);
        $this->supplierElastic->updateIndex(collect($supplier)->toArray());
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Supplier $supplier): void
    {
        $supplier = SupplierResource::make($supplier);
        $this->supplierElastic->updateIndex(collect($supplier)->toArray());
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Supplier $supplier): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Supplier $supplier): void
    {
        //
    }
}
