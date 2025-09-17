# Directam Elastic Logger

A reusable Laravel custom log channel for shipping logs to Elasticsearch (ELK) using Monolog v3 and the official `elasticsearch/elasticsearch` client.

## Features

- Custom Monolog channel via Laravel `custom` driver
- Daily index naming: `<index_prefix>_<project_name>_YYYY.MM.DD`
- Extra context processor adds `service.name` and `labels.project`
- Auto-merges an `elastic` channel into `config('logging.channels')` (no publish step)

## Installation

### 1) Install via Composer (Packagist)

```bash
composer require directam/elastic-logger
```

### 2) Configuration

- No publishing is required. The `elastic` channel is registered automatically at runtime.
- Configure via environment variables (see below).
- Optional: publish the package config if you want a dedicated config file in your app:

```bash
php artisan vendor:publish --provider="Directam\\ElasticLogger\\ElasticLoggerServiceProvider" --tag=config
```

## Configuration

Environment variables:

- `ELASTIC_HOST` (default: `localhost`)
- `ELASTIC_API_KEY` (optional API key string)
- `ELASTIC_INDEX_PREFIX` (default: `laravel_logs`)
- `ELASTIC_PROJECT_NAME` (default: `Laravel`)

## Usage

Use the channel in code:

```php
Log::channel('elastic')->info('User logged in', ['user_id' => 123]);
```

Or set the default stack to include it:

```env
LOG_STACK=single,elastic
```

## How it works

- Builds an Elasticsearch client using hosts and API key.
- Pushes a Monolog `ElasticsearchHandler` with daily index naming.
- Adds `ElasticServiceProcessor` to enrich records with service and project metadata.

## Version Compatibility

- PHP: >= 8.2
- Laravel: 10–12
- Monolog: 3
- elasticsearch/elasticsearch: 9

## License

MIT


