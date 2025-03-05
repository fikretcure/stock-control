<?php

namespace App\Services\Elastic;

use App\Models\Supplier;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

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


    /**
     * @param object $supplier
     * @return array
     */
    protected function dataDto(object $supplier): array
    {
        return [
            'id' => $supplier->id,
            'name' => $supplier->name,
            'reg_no' => $supplier->reg_no,
            'created_at' => $supplier->created_at,
        ];
    }


    /**
     * @param object $category
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function store(object $category): void
    {
        parent::storeIndex($this->dataDto($category));
    }


    /**
     * @param object $category
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function update(object $category): void
    {
        parent::updateIndex($this->dataDto($category));
    }
}
