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

    public function isThere(string $string = 'die'): void
    {
        $this->opened_file = $this->openForRead();
        $lines = [];

        while (!\feof($this->opened_file)) {
//            if (\str_contains(\fgets($this->opened_file), $string)) {
//                echo "The string 'lazy' was found in the string\n";
//            }
            $lines[] = \fgets($this->opened_file);
        }

        \print_r($lines);

        $this->closeFile();
    }

    private function openForRead()
    {
        return \fopen($this->file_name, 'rb');
    }

    private function openForUpdate(): bool
    {
    }

    private function openForCreate(): bool
    {
    }

    private function closeFile(): void
    {
        \fclose($this->opened_file);
    }
}
