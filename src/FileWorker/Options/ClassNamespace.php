<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\FileWorker\Options;

class ClassNamespace
{
    public static function getFullNamespace($file): string|false
    {
        $pattern = '/(namespace)\s+(?:\\\\{1,2}\w+|\w+\\\\{1,2})(?:\w+\\\\{0,2})+/';
        $useNamespaces = self::fetchByPattern($file, $pattern);
        if (empty($useNamespaces[0])) {
            return false;
        }
//        die(var_dump($useNamespaces));
//        $namespaces = preg_replace('/(namespace)\s+/', '', $useNamespaces[0]);

        return $useNamespaces[0] . ';';
    }

    private static function fetchByPattern($file, $pattern): array|null
    {
        preg_match($pattern, $file->content(), $matches);

        return $matches ?? null;
    }

    public static function isThereNamespace($file): bool
    {
        if (! self::getFullNamespace($file)) {
            return false;
        }
        return true;
    }
}
