<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker;

final class File
{
    private string $file_name;

    private $opened_file;

    public function __construct($path)
    {
        $this->file_name = $path;
    }


    public function isThere(string $string): false|array
    {
        $this->openFileForRead();
        $errLines = [];
        $i = 1;

        while (! \feof($this->opened_file)) {
            $line = \fgets($this->opened_file);
            if (\is_bool($line)) {
                continue;
            }
            if (\str_contains($line, $string)) {
                $errLines[] = $i;
            }
            ++$i;
        }
        $this->closeFile();

        if (empty($errLines)) {
            return false;
        }

        return $errLines;
    }

    private function openFileForRead(): void
    {
        $this->opened_file = \fopen($this->file_name, 'rb');
    }

    public function namespaces(): array|false
    {
        $this->openFileForRead();
        $namespaces = [];
        $namespace = 'use' . ' ' . '((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)' . ';';
        $i = 1;
        while (! \feof($this->opened_file)) {
            $line = \fgets($this->opened_file);
            if (\is_bool($line)) {
                continue;
            }
            if (\str_contains($line, $namespace)) {
                $errLines[] = $i;
            }
            ++$i;
        }
        $this->closeFile();

        if (empty($errLines)) {
            return false;
        }

        return $errLines;
    }

    private function openForUpdate(): void
    {
    }

    private function openForCreate(): void
    {
    }

    private function closeFile(): void
    {
        \fclose($this->opened_file);
    }
}
