<?php

namespace Directam\ElasticLogger;

use Monolog\Processor\ProcessorInterface;

class ElasticServiceProcessor implements ProcessorInterface
{
    public function __construct(private readonly string $projectName)
    {
    }

    public function __invoke(\Monolog\LogRecord $record): array|\Monolog\LogRecord
    {
        $record['extra']['service'] = [
            'name' => config('app.name'),
        ];
        $record['extra']['labels']['project'] = $this->projectName;
        return $record;
    }
}



