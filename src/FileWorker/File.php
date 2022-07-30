<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker;

class File
{
    protected string $file_name;

    public $opened_file;

    public function __construct($path)
    {
        $this->file_name = $path;
    }

    public function openFileForRead(): void
    {
        $this->opened_file = \fopen($this->file_name, 'rb');
    }

    protected function openForUpdate(): void
    {
        if (! $this->opened_file = fopen($this->file_name, 'w')) {
            echo "Cannot open file ($this->file_name)";
            exit;
        }
    }

    protected function openForCreate(): void
    {
    }

    protected function closeFile(): void
    {
        \fclose($this->opened_file);
    }

    public function content(): string
    {
        $this->openFileForRead();
        (string) $content = fread($this->opened_file, filesize($this->file_name));
        $this->closeFile();

        return $content;
    }

    public function newContent(string $newContent): void
    {
        if (is_writable($this->file_name)) {
            $this->openForUpdate();
            if (fwrite($this->opened_file, $newContent) === false) {
                echo "Cannot write to file ($this->file_name)";
                exit;
            }
            echo "Success, wrote new content to file ($this->file_name)";
            $this->closeFile();
        } else {
            echo "The file {$this->file_name} is not writable";
        }
    }
}
