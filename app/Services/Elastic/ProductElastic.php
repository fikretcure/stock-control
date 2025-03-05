<?php

namespace App\Services\Elastic;

use App\Models\Product;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

/**
 *
 */
class ProductElastic extends ElasticService
{

    /**
     * @throws AuthenticationException
     */
    public function __construct(){
        parent::__construct(new Product()->getTable());
    }


    /**
     * @param object $product
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function store(object $product): void
    {
        $params = [
            'id' => $product->id,
            'name' => $product->name,
            'reg_no' => $product->reg_no,
            'created_at' => $product->created_at,
        ];
        parent::storeIndex($params);
    }
}
