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
        parent::storeIndex($this->dataDto($product));
    }

    public function update(object $product): void
    {
        parent::updateIndex($this->dataDto($product));
    }

    protected function dataDto(object $product): array
    {
       return [
            'id' => $product->id,
            'name' => $product->name,
            'reg_no' => $product->reg_no,
            'alias' => $product->alias,
            'category_id' => $product->category_id,
            'category' => $product->category,
            'created_at' => $product->created_at,
            'delete_at' => $product->delete_at,
        ];
    }
}
