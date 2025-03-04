<?php

namespace App\Services\Elastic;

use Carbon\Carbon;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use Elastic\Elasticsearch\Response\Elasticsearch;
use Http\Promise\Promise;
use Illuminate\Pagination\LengthAwarePaginator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 *
 */
class ElasticService
{
    /**
     * @var Client
     */
    public Client $client;

    /**
     * @param string $index
     * @throws AuthenticationException
     */
    public function __construct(
        public string $index
    )
    {
        $this->client = ClientBuilder::create()->setHosts(['http://elasticsearch:9200'])->build();
    }


    /**
     * @param $id
     * @return mixed
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function show($id): mixed
    {
        return $this->client->get([
            'index' => $this->index,
            'id' => $id
        ])->asArray()['_source'];
    }


    /**
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function createIndex(): void
    {

        $params = [
            'index' => $this->index,
            'body' => [
                'mappings' => [
                    'properties' => [
                        'id' => ['type' => 'integer'],
                        'created_at' => ['type' => 'date'],
                    ],
                ],
            ],
        ];

        $this->client->indices()->create($params);
    }

    /**
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function deleteIndex(): void
    {
        $this->client->indices()->delete([
            'index' => $this->index,
        ]);
    }


    /**
     * @param array $body
     * @return void
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function index(array $body = []): void
    {
        $body['created_at'] = Carbon::parse($body['created_at'])->toIso8601String();
        $params = [
            'index' => $this->index,
            'id' => $body['id'],
            'body' => $body,
        ];
        $this->client->index($params);
    }

    /**
     * @return LengthAwarePaginator
     * @throws ClientResponseException
     * @throws ServerResponseException
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function search(): LengthAwarePaginator
    {
        $page = request()->get('page', 1); // Varsayılan olarak 1. sayfa
        $perPage = request()->get('per_page', 10);
        $from = ($page - 1) * $perPage;

        $sort = request()->get('sort', 'id');
        $order = request()->get('order', 'desc');



        $param = [
            'index' => 'categories',
            'body' => [
                'from' => $from,
                'size' => $perPage,
                'sort' => [
                    $sort => [ // .keyword alt alanını kullanıyoruz
                        'order' => $order,
                    ],
                ],
            ],
        ];


        $response = $this->client->search($param);
        $hits = collect($response['hits']['hits'])->map(function ($item) {
            return $item['_source'];
        });

        $total = $response['hits']['total']['value'];

        return  new LengthAwarePaginator(
            collect($hits),
            $total,
            $perPage,
            $page,
            ['path' => request()->url()]
        );

    }


    /**
     * @param array $body
     * @return Elasticsearch|Promise
     * @throws ClientResponseException
     * @throws MissingParameterException
     * @throws ServerResponseException
     */
    public function updateIndex(array $body = []): Elasticsearch|Promise
    {
        $params = [
            'index' => $this->index,
            'id' => $body['id'],
            'body' => ['doc' => $body],
        ];
        return $this->client->update($params);
    }
}
