<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Services\Elastic\SupplierElastic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class SupplierController extends Controller
{

    /**
     * @param SupplierElastic $supplierElastic
     */
    public function __construct(
        public SupplierElastic $supplierElastic,
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
            return $this->success($this->supplierElastic->search());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param StoreSupplierRequest $request
     * @return JsonResponse
     */
    public function store(StoreSupplierRequest $request): JsonResponse
    {
        try {
            $supplier = Supplier::create($request->validated());
            return $this->success(SupplierResource::make($supplier));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param $supplier
     * @return JsonResponse
     */
    public function show($supplier): JsonResponse
    {
        try {
            return $this->success($this->supplierElastic->show($supplier));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param UpdateSupplierRequest $request
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier): JsonResponse
    {
        try {
            $supplier->update($request->validated());
            return $this->success(SupplierResource::make($supplier->refresh()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param Supplier $supplier
     * @return JsonResponse
     */
    public function destroy(Supplier $supplier): JsonResponse
    {
        try {
            $supplier->delete();
            return $this->success(SupplierResource::make($supplier->refresh()));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }
}
