# elavora/api-log-file

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
