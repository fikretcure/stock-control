<?php

namespace App\Services\Elastic;

use App\Models\Category;

class CategoryElastic extends ElasticService
{

    public function __construct(){
        parent::__construct(new Category()->getTable());
    }


    public function store(object $category){
        $params = [
            'id' => $category->id,
            'name' => $category->name,
            'reg_no' => $category->reg_no,
            'category_id' => $category->category_id,
            'created_at' => $category->created_at,
        ];
        parent::index($params);
    }
}
