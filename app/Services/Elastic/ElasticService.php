<?php

namespace App\Services\Elastic;

use Carbon\Carbon;
use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Pagination\LengthAwarePaginator;

class ElasticService
{
    public \Elastic\Elasticsearch\Client $client;

    public function __construct(
        public string $index
    )
    {
        $this->client = ClientBuilder::create()->setHosts(['http://elasticsearch:9200'])->build();
    }



    public function createIndex()
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

    public function deleteIndex()
    {
        $this->client->indices()->delete([
            'index' => $this->index,
        ]);
    }




    public function index($body = [])
    {
        $body['created_at'] = Carbon::parse($body['created_at'])->toIso8601String();
        $params = [
            'index' => $this->index,
            'id' => $body['id'],
            'body' => $body,
        ];
        $this->client->index($params);
    }

    public function search()
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
}
