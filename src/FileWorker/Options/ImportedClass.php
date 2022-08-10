<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker\Options;

class ImportedClass
{
    public static function allImports($file): false|array
    {
        $pattern = '/(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/m';
        $namespaces = self::fetchByPattern($file, $pattern);
        if (empty($namespaces)) {
            return false;
        }

        return $namespaces[0];
    }

    public static function useImports($file): array|false
    {
        $pattern = '/(use)\s+(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/';
        $useNamespaces = self::fetchByPattern($file, $pattern);
        if (empty($useNamespaces[0])) {
            return false;
        }
        foreach ($useNamespaces[0] as $name) {
            $namespaces[] = preg_replace('/(use)\s+/', '', $name);
        }

        return $namespaces;
    }

    private static function fetchByPattern($file, $pattern): array|null
    {
        preg_match_all($pattern, $file->content(), $matches);

        return $matches ?? null;
    }
}
