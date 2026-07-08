# Guia de uso

Pacote opcional de logs em arquivo para o framework Elavora.

## Instalacao

```bash
composer require elavora/api-log-file
```

## Quando usar

- Enviar logs para stdout, arquivo ou MongoDB sem trocar a aplicacao.
- Registrar um writer compativel com o logger do framework.
- Padronizar observabilidade por ambiente.

## Exemplo rapido

```php
use Elavora\Api\Extension\LogFile\FileLogExtension;

$application->extend(new FileLogExtension([
    // Ajuste as opcoes conforme o destino de log escolhido.
]));
```

## Principais pontos de entrada

- `Elavora\Api\Extension\LogFile\FileLogConfig`
- `Elavora\Api\Extension\LogFile\FileLogExtension`
- `Elavora\Api\Extension\LogFile\FileLogWriter`
- `Elavora\Api\Extension\LogFile\Contracts\LogWriter`

## Dependencias de runtime

- `elavora/api-framework` `^0.3.1`

## Validacao no projeto consumidor

Depois de instalar o pacote, rode os testes da aplicacao consumidora. Para uma verificacao isolada do pacote, use container:

```bash
docker run --rm -v "${PWD}:/workspace" -w "/workspace/api-log-file" composer:2 composer validate --strict --no-check-publish
docker run --rm -v "${PWD}:/workspace" -w "/workspace/api-log-file" composer:2 sh -lc "find . \\( -path ./.git -o -path ./vendor \\) -prune -o -name '*.php' -print0 | xargs -0 -r -n1 php -l"
```

## Observacoes

- Mantenha regras de produto fora deste pacote.
- Prefira configurar extensoes no bootstrap da aplicacao.
- Instale apenas os modulos que a aplicacao realmente usa.