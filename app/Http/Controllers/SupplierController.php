<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use App\Services\Elastic\SupplierElastic;

class SupplierController extends Controller
{

    /**
     * @param SupplierElastic $supplierElastic
     */
    public function __construct(
        public SupplierElastic $supplierElastic,
    ){

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success($this->supplierElastic->search());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSupplierRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
