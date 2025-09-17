<?php

namespace Directam\ElasticLogger;

use Directam\ElasticLogger\ElasticServiceProcessor;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Monolog\Handler\ElasticsearchHandler;
use Monolog\Logger;

class ElasticLogger
{
    /**
     * Create a Monolog Logger instance configured for Elasticsearch.
     *
     * @param array<string,mixed> $config
     * @throws AuthenticationException
     */
    public function __invoke(array $config): Logger
    {
        $client = ClientBuilder::create()
            ->setHosts([$config['host'] ?? 'localhost'])
            ->setApiKey($config['api_key'] ?? null)
            ->build();

        $options = [
            'index' => sprintf(
                '%s_%s_%s',
                $config['index_prefix'] ?? 'laravel_logs',
                $config['project_name'] ?? 'Laravel',
                date('Y.m.d')
            ),
            'type' => '_doc',
        ];

        $handler = new ElasticsearchHandler($client, $options);

        $logger = new Logger('elastic');
        $logger->pushProcessor(new ElasticServiceProcessor($config['project_name'] ?? 'Laravel'));
        $logger->pushHandler($handler);

        return $logger;
    }
}



