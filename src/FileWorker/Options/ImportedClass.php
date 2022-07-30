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

    public function useImports(): array|null
    {

    }

    private static function fetchAllNamespaces($file): array|null
    {
        $pattern = '/(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/m';
        preg_match_all($pattern, $file->content(), $matches);
        if (isset($matches[0])) {
            $namespaces[] = $matches[0];
        }

        return $namespaces ?? null;
    }
}
