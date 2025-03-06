<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Elastic\CategoryElastic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class CategoryController extends Controller
{
    /**
     * @param CategoryElastic $categoryElastic
     */
    public function __construct(
        public CategoryElastic $categoryElastic,
    )
    {

    }


    public function index(): JsonResponse
    {
        return $this->success($this->categoryElastic->search());
    }


    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        DB::beginTransaction();
        try {
            $category = Category::create($request->validated());
            return $this->success(CategoryResource::make($category));
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    public function show($company): JsonResponse
    {
        return $this->success($this->categoryElastic->show($company));
    }


    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        DB::beginTransaction();
        try {
            $category->update($request->validated());
            return $this->success($category->refresh());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }


    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        DB::beginTransaction();
        try {
            $category->delete();
            return $this->success($category->refresh());
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }
}
