<?php

namespace App\Services\Elastic;

use App\Models\Category;
use Elastic\Elasticsearch\Exception\AuthenticationException;

/**
 *
 */
class CategoryElastic extends ElasticService
{

    /**
     * @throws AuthenticationException
     */
    public function __construct(){
        parent::__construct(new Category()->getTable());
    }
}
