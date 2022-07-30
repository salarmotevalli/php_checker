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

        return $namespaces;
    }

    public static function useImports($file): array|null
    {
        $pattern = '/(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/m';
        $namespaces = self::fetchByPattern($file, $pattern);
        if (empty($namespaces)) {
            return false;
        }

        return $namespaces;
    }

    private static function fetchByPattern($file, $pattern): array|null
    {
        preg_match_all($pattern, $file->content(), $matches);
        return $matches ?? null;
    }
}
