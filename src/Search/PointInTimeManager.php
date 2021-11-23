<?php declare(strict_types=1);

namespace ElasticAdapter\Search;

use Elasticsearch\Client;

final class PointInTimeManager
{
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function open(string $indexName, string $keepAlive = null): string
    {
        $params = ['index' => $indexName];

        if (isset($keepAlive)) {
            $params['keep_alive'] = $keepAlive;
        }

        $response = $this->client->openPointInTime($params);

        return $response['id'];
    }

    public function close(string $pointInTimeId): self
    {
        $this->client->closePointInTime([
            'body' => [
                'id' => $pointInTimeId,
            ],
        ]);

        return $this;
    }
}
