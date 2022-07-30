<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker\Options;

class ImportedClass
{
    public static function allImports($file): false|array
    {
        $namespaces = self::fetchAllNamespaces($file);
        if (empty($namespaces)) {
            return false;
        }

        return $namespaces;
    }

    private static function fetchAllNamespaces($file): array|null
    {
        while (! \feof($file)) {
            $line = \fgets($file);
            if (\is_bool($line)) {
                continue;
            }
            $pattern = '/(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/m';
            preg_match($pattern, $line, $matches);
            if (isset($matches[0])) {
                $namespaces[] = $matches[0];
            }
        }

        return $namespaces ?? null;
    }
}
