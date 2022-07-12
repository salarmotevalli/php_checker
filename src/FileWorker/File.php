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

    public function isThere(string $string = 'die'): false|array
    {
        $this->openFileForRead();
        $stringLines = [];
        $i = 1;

        while (!\feof($this->opened_file)) {
            $line = \fgets($this->opened_file);

            if (\str_contains($line, $string)) {
                $stringLines[] = $i;
            }
            ++$i;
        }
        $this->closeFile();

        if (empty($stringLines)) {
            return false;
        }

        return $stringLines;
    }

    private function openFileForRead(): void
    {
        $this->opened_file = \fopen($this->file_name, 'rb');
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
