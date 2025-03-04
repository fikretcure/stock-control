<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\Elastic\CategoryElastic;

class CategoryController extends Controller
{
    public function __construct(
        public CategoryElastic $categoryElastic,
    ){

    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success($this->categoryElastic->search());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //
    }

    public function show($company)
    {
        return $this->success($this->categoryElastic->show($company));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
