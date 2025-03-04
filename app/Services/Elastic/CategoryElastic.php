<?php

namespace App\Services\Elastic;

use App\Models\Category;

class CategoryElastic extends ElasticService
{

    public function __construct(){
        parent::__construct(new Category()->getTable());
    }


    protected function dataDto(object $category){
        return [
            'id' => $category->id,
            'name' => $category->name,
            'alias' => $category->alias,
            'reg_no' => $category->reg_no,
            'parent' => $category->parent,
            'all_parents' => $category->all_parents,
            'created_at' => $category->created_at,
            'deleted_at' => $category->deleted_at,
        ];
    }


    public function store(object $category){
        parent::index($this->dataDto($category));
    }


    public function update(object $category)
    {
        parent::updateIndex($this->dataDto($category));
    }
}
