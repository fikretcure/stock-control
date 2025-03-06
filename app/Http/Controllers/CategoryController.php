<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Elastic\CategoryElastic;
use Illuminate\Http\JsonResponse;

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
    ){

    }


    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success($this->categoryElastic->search());
    }


    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $category = Category::create($request->validated());
        $this->categoryElastic->store($category);
        return $this->success($category);
    }

    /**
     * @param $company
     * @return JsonResponse
     */
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
        $category->update($request->validated());
        $this->categoryElastic->update($category->refresh());
        return $this->success($category->refresh());
    }


    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $category->delete();
        $this->categoryElastic->update($category->refresh());
        return $this->success($category->refresh());
    }
}
