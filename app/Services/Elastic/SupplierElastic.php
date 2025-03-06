<?php

namespace App\Services\Elastic;

use App\Models\Supplier;
use Elastic\Elasticsearch\Exception\AuthenticationException;

/**
 *
 */
class SupplierElastic extends ElasticService
{

    /**
     * @throws AuthenticationException
     */
    public function __construct(){
        parent::__construct(new Supplier()->getTable());
    }
}
