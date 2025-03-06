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

}
