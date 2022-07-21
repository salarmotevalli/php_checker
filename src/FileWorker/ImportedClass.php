<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker;

class ImportedClass extends AbstractFile
{
    public function allImports(): false|array
    {
        $this->openFileForRead();
        $namespaces = $this->fetchAllNamespaces();
        $this->closeFile();
        if (empty($namespaces)) {
            return false;
        }

        return $namespaces;
    }

    private function fetchAllNamespaces(): array|null
    {
        while (! \feof($this->opened_file)) {
            $line = \fgets($this->opened_file);
            if (\is_bool($line)) {
                continue;
            }
            $pattern = '/(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/m';
            preg_match($pattern, $line, $matches, 0, 0);
            if (isset($matches[0])) {
                $namespaces[] = $matches[0];
            }
        }

        return $namespaces ?? null;
    }
}
