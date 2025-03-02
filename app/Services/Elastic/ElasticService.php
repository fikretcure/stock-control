<?php

namespace App\Services\Elastic;

use Carbon\Carbon;
use Elastic\Elasticsearch\ClientBuilder;

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

}
