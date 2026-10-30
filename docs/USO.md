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

- PHP `>=8.3`
- `elavora/api-framework` `^2.0`

## Versão e compatibilidade

A versão `1.0` exige PHP `>=8.3` e `elavora/api-framework` `^2.0`. Antes (`0.x`), o pacote aceitava PHP `>=8.1` e
`elavora/api-framework` `^0.3.1`. Para atualizar a partir da `0.2.0`, troque as restrições no `composer.json` do seu
projeto e rode `composer update elavora/api-framework elavora/api-log-file`:

```json
{
  "require": {
    "php": ">=8.3",
    "elavora/api-framework": "^2.0",
    "elavora/api-log-file": "^1.0"
  }
}
```

A API do pacote não muda: `FileLogExtension`, `FileLogWriter`, `FileLogConfig` e `Contracts\LogWriter` mantêm
namespaces, assinaturas e comportamento. Só a dependência do framework sobe de major (e o PHP mínimo sobe para 8.3).
O pacote usa os contratos `Elavora\Api\Framework\Contracts\Extension` e `Elavora\Api\Framework\Contracts\LogWriter`
e o `Elavora\Api\Framework\Logging\Logger` do framework 2.

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
