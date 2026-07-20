# elavora/api-log-file

[![Packagist Version](https://img.shields.io/packagist/v/elavora/api-log-file.svg?style=flat-square)](https://packagist.org/packages/elavora/api-log-file)
[![PHP Version](https://img.shields.io/packagist/php-v/elavora/api-log-file.svg?style=flat-square)](https://packagist.org/packages/elavora/api-log-file)
[![Composer Quality](https://github.com/Elavora/api-log-file/actions/workflows/quality.yml/badge.svg?branch=main)](https://github.com/Elavora/api-log-file/actions/workflows/quality.yml)
[![CodeQL](https://github.com/Elavora/api-log-file/actions/workflows/codeql.yml/badge.svg?branch=main)](https://github.com/Elavora/api-log-file/actions/workflows/codeql.yml)
[![License](https://img.shields.io/packagist/l/elavora/api-log-file.svg?style=flat-square)](LICENSE)
Pacote opcional de logs em arquivo para o framework Elavora.

```php
use Elavora\Api\Extension\LogFile\FileLogExtension;
use Elavora\Api\Framework\Logging\Logger;

$application->extend(new FileLogExtension([
    'path' => __DIR__ . '/../storage/logs/app.log',
]));

$application->container()
    ->get(Logger::class)
    ->info('Requisicao recebida', ['route' => '/health']);
```

Cada entrada e gravada como uma linha JSON com o formato:

```php
[
    'timestamp' => gmdate('c'),
    'level' => 'info',
    'message' => 'Requisicao recebida',
    'request_id' => '...',
    'context' => [],
]
```

O pacote implementa `Elavora\Api\Framework\Contracts\LogWriter` e deve ser
instalado somente quando a aplicacao precisar gravar logs em arquivo.
