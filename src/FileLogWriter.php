<?php

declare(strict_types=1);

namespace Elavora\Api\Extension\LogFile;

use Elavora\Api\Extension\LogFile\Contracts\LogWriter;
use Closure;
use JsonException;
use RuntimeException;

final class FileLogWriter implements LogWriter
{
    /** @var Closure(string, string, int): (int|false) */
    private readonly Closure $writeFile;

    /**
     * @param FileLogConfig $config Configuracao do arquivo de destino.
     * @param null|callable(string, string, int): (int|false) $writeFile Escritor injetavel para falhas controladas.
     */
    public function __construct(
        private readonly FileLogConfig $config,
        ?callable $writeFile = null
    ) {
        $this->writeFile = $writeFile === null
            ? static fn (string $path, string $line, int $flags): int|false => @file_put_contents(
                $path,
                $line,
                $flags
            )
            : Closure::fromCallable($writeFile);
    }

    /**
     * @throws JsonException
     */
    public function write(array $entry): void
    {
        $directory = dirname($this->config->path());
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException('Nao foi possivel criar o diretorio de logs.');
        }

        $line = json_encode(
            $entry,
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ) . PHP_EOL;
        $writtenBytes = ($this->writeFile)(
            $this->config->path(),
            $line,
            FILE_APPEND | LOCK_EX
        );

        if ($writtenBytes === false || $writtenBytes !== strlen($line)) {
            throw new RuntimeException('Nao foi possivel concluir a gravacao do log em arquivo.');
        }
    }
}
