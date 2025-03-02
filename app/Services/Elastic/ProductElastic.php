<?php

namespace App\Services\Elastic;

use App\Models\Product;

class ProductElastic extends ElasticService
{

    public function __construct(){
        parent::__construct(new Product()->getTable());
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
