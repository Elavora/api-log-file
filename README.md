# api-log-file

[![Packagist Version](https://img.shields.io/packagist/v/elavora/api-log-file.svg?style=flat-square)](https://packagist.org/packages/elavora/api-log-file)
[![PHP Version](https://img.shields.io/packagist/php-v/elavora/api-log-file.svg?style=flat-square)](https://packagist.org/packages/elavora/api-log-file)
[![Composer Quality](https://github.com/Elavora/api-log-file/actions/workflows/quality.yml/badge.svg?branch=main)](https://github.com/Elavora/api-log-file/actions/workflows/quality.yml)
[![CodeQL](https://github.com/Elavora/api-log-file/actions/workflows/codeql.yml/badge.svg?branch=main)](https://github.com/Elavora/api-log-file/actions/workflows/codeql.yml)
[![License](https://img.shields.io/packagist/l/elavora/api-log-file.svg?style=flat-square)](https://packagist.org/packages/elavora/api-log-file)

Writer opcional que grava cada entrada de log estruturado em uma linha JSON.

## Requisitos

- PHP 8.3 ou superior.
- `elavora/api-framework` 1.x.

## Instalacao

```bash
composer require elavora/api-log-file
```

## Inicio rapido

```php
use Elavora\Api\Extension\LogFile\FileLogExtension;
use Elavora\Api\Framework\Application;
use Elavora\Api\Framework\Logging\Logger;

$application = Application::create()->extend(new FileLogExtension([
    'path' => sys_get_temp_dir() . '/elavora/app.log',
]));

$application->container()
    ->get(Logger::class)
    ->info('Requisicao recebida', ['route' => '/health']);
```

O writer cria diretorios ausentes e lanca `RuntimeException` se a linha nao for gravada integralmente.

## Documentacao

Consulte o [guia de uso](docs/USO.md) para configuracao e validacao local.
