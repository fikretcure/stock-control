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
        $supplier = Supplier::create($request->validated());
        $this->supplierElastic->store($supplier);
        return $this->success($supplier);
    }

    /**
     * Display the specified resource.
     */
    public function show($supplier)
    {
        return $this->success($this->supplierElastic->show($supplier));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());
        $this->supplierElastic->update($supplier->refresh());
        return $this->success($supplier->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        $this->supplierElastic->update($supplier->refresh());
        return $this->success($supplier->refresh());
    }
}
