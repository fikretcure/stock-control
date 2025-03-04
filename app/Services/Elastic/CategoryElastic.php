<?php

namespace App\Services\Elastic;

use App\Models\Category;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;

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


    /**
     * @param object $category
     * @return array
     */
    protected function dataDto(object $category): array
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
            'alias' => $category->alias,
            'reg_no' => $category->reg_no,
            'parent' => $category->parent,
            'all_parents' => $category->all_parents,
            'created_at' => $category->created_at,
            'deleted_at' => $category->deleted_at,
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
        parent::index($this->dataDto($category));
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
