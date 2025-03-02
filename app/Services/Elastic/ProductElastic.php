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
            'reg_no' => $product->reg_no,
            'created_at' => $product->created_at,
        ];
        parent::index($params);
    }
}
