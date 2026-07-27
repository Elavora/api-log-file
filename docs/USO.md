# Guia de uso

`FileLogExtension` registra o contrato de writer e o `Logger` do framework.

```php
use Elavora\Api\Extension\LogFile\FileLogExtension;
use Elavora\Api\Framework\Application;
use Elavora\Api\Framework\Logging\Logger;

$application = Application::create()->extend(new FileLogExtension([
    'path' => __DIR__ . '/storage/logs/application.log',
]));

$logger = $application->container()->get(Logger::class);
$logger->error('Falha ao processar pedido', ['order_id' => 42]);
```

Cada chamada acrescenta uma linha JSON terminada por `PHP_EOL`, com bloqueio exclusivo durante a escrita. Falhas nativas e escritas curtas geram `RuntimeException` sem expor o conteudo do log.

## Validacao do pacote

Execute a partir da raiz do clone:

```bash
docker run --rm -v "${PWD}:/workspace" -w /workspace composer:2 composer update --no-interaction --no-progress --prefer-dist
docker run --rm -v "${PWD}:/workspace" -w /workspace composer:2 composer check
```
