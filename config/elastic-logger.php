<?php

return [
    'driver' => 'custom',
    'via'    => \Directam\ElasticLogger\ElasticLogger::class,
    'level'  => 'debug',
    'host' => env('ELASTIC_HOST', 'localhost'),
    'api_key' => env('ELASTIC_API_KEY'),
    'index_prefix' => env('ELASTIC_INDEX_PREFIX', 'laravel_logs'),
    'project_name' => env('ELASTIC_PROJECT_NAME', 'Laravel'),
];



