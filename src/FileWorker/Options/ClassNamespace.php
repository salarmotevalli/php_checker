<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker\Options;

class ClassNamespace
{
    public static function getNamespace($file): array|false
    {
        $pattern = '/(namespace)\s+(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/';
        $namespace = self::fetchByPattern($file, $pattern);
        if (empty($useNamespaces[0])) {
            return false;
        }

        return $namespace;
    }

    private static function fetchByPattern($file, $pattern): array|null
    {
        preg_match_all($pattern, $file->content(), $matches);

        return $matches ?? null;
    }
}
