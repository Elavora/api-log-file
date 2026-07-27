<?php

declare(strict_types=1);

use Elavora\Api\Extension\LogFile\FileLogConfig;
use Elavora\Api\Extension\LogFile\FileLogWriter;
use PHPUnit\Framework\TestCase;

final class FileLogWriterFailureTest extends TestCase
{
    public function testThrowsWhenNativeWriteFails(): void
    {
        $receivedLine = null;
        $receivedFlags = null;
        $writer = new FileLogWriter(
            FileLogConfig::fromArray([
                'path' => sys_get_temp_dir() . '/api-log-file-failure.log',
            ]),
            static function (string $path, string $line, int $flags) use (
                &$receivedLine,
                &$receivedFlags
            ): false {
                $receivedLine = $line;
                $receivedFlags = $flags;

                return false;
            }
        );

        try {
            $writer->write(['message' => 'conteudo-sensivel']);
            self::fail('A falha de escrita deveria lancar RuntimeException.');
        } catch (RuntimeException $exception) {
            self::assertStringNotContainsString('conteudo-sensivel', $exception->getMessage());
        }

        self::assertSame(FILE_APPEND | LOCK_EX, $receivedFlags);
        self::assertIsString($receivedLine);
        self::assertStringEndsWith(PHP_EOL, $receivedLine);
    }

    public function testThrowsWhenWriteIsShort(): void
    {
        $writer = new FileLogWriter(
            FileLogConfig::fromArray([
                'path' => sys_get_temp_dir() . '/api-log-file-short-write.log',
            ]),
            static fn (string $path, string $line, int $flags): int => strlen($line) - 1
        );

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Nao foi possivel concluir a gravacao do log em arquivo.');

        $writer->write(['message' => 'teste']);
    }
}
