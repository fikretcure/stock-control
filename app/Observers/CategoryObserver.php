<?php

namespace App\Observers;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Elastic\CategoryElastic;

class CategoryObserver
{


    /**
     * @param CategoryElastic $categoryElastic
     */
    public function __construct(
        public CategoryElastic $categoryElastic,
    )
    {

    }

    /**
     * Handle the Category "created" event.
     */
    public function created(Category $category): void
    {
        $category = CategoryResource::make($category);
        $this->categoryElastic->storeIndex(collect($category)->toArray());
    }

    /**
     * Handle the Category "updated" event.
     */
    public function updated(Category $category): void
    {
        $category = CategoryResource::make($category);
        $this->categoryElastic->updateIndex(collect($category)->toArray());
    }

    /**
     * Handle the Category "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $category = CategoryResource::make($category);
        $this->categoryElastic->updateIndex(collect($category)->toArray());
    }

    /**
     * Handle the Category "restored" event.
     */
    public function restored(Category $category): void
    {
        //
    }

    /**
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        //
    }
}
