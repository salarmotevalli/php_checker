<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker;

abstract class AbstractFile
{
    private string $file_name;

    private $opened_file;

    public function __construct($path)
    {
        $this->file_name = $path;
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
