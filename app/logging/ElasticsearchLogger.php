<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\ElasticsearchHandler;
use Monolog\Formatter\ElasticsearchFormatter;
use Elasticsearch\ClientBuilder;

class ElasticsearchLogger
{
    public function __invoke(array $config)
    {
        $client = ClientBuilder::create()
            ->setHosts(['http://localhost:9200']) // seu ES
            ->build();

        $handler = new ElasticsearchHandler(
            $client,
            [
                'index' => 'laravel-logs', // nome do índice no ES
                'type' => '_doc',
            ],
            Logger::DEBUG
        );

        $handler->setFormatter(new ElasticsearchFormatter('laravel-logs', '_doc'));

        return new Logger('elasticsearch', [$handler]);
    }
}