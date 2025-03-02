<?php

namespace App\Services\Elastic;

use App\Models\Category;

class CategoryElastic extends ElasticService
{

    public function __construct(){
        parent::__construct(new Category()->getTable());
    }


    public function store(object $product){
        $params = [
            'id' => $product->id,
            'name' => $product->name,
            'created_at' => $product->created_at,
        ];
        parent::index($params);
    }
}
