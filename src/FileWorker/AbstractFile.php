<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker;

abstract class AbstractFile
{
    protected string $file_name;

    protected mixed $opened_file;

    public function __construct($path)
    {
        $this->file_name = $path;
    }

    protected function openFileForRead(): void
    {
        $this->opened_file = \fopen($this->file_name, 'rb');
    }

    protected function openForUpdate(): void
    {
    }

    protected function openForCreate(): void
    {
    }

    protected function closeFile(): void
    {
        \fclose($this->opened_file);
    }

//    public function content(): s
}
