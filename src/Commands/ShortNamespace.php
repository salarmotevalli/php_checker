<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\ImportedClass;
use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

class ShortNamespace extends CommandAbstract
{
    public function main()
    {
        // open
        (object) $file = new ImportedClass('read.php');
        // get prevNamespaces
        $prevNamespaces = $file->allImports();
        if (! $prevNamespaces) {
            echo "\033[31m**/\033[0m there is not any namespace of classes in the file \033[31m/**\033[0m" . PHP_EOL;
            exit;
        }

        // find equal namespace
        (array) $validNamespacesArray = [];
        foreach ($prevNamespaces as $item) {
            (array) $separated = explode('\\', $item);
            (string) $class = end($separated);
            array_pop($separated);
            (string) $namespace = implode('\\', $separated);
            $validNamespacesArray[$namespace][] = $class;
        }

        // replace imports
        $prevContent = $file->content();
        $contentWithouteNamespaces = $prevContent;

        foreach ($prevNamespaces as $name) {
            (string) $fullLineNamespace = 'use' . ' ' . $name . ';';
            $contentWithouteNamespaces = str_replace($fullLineNamespace, '', $contentWithouteNamespaces);
        }

        (string) $validNamespaces = '';
        foreach ($validNamespacesArray as $name => $class) {
            if (count($class) == 1) {
                (string) $implodeClasses = $class[0];
            } else {
                $implodeClasses = '{' . implode(', ', $class) . '}';
            }
            $validNamespaces .= $name . '\\' . $implodeClasses . PHP_EOL;
        }

        (string) $declare = 'declare(strict_types=1);';
        if (str_contains($contentWithouteNamespaces, $declare)) {
            $newContent = str_replace($declare, $declare . PHP_EOL . PHP_EOL . $validNamespaces, $contentWithouteNamespaces);
        }

        $file->newContent($newContent);

        // change with short form
        // replace in file
        // done
    }

    public static function description(): string
    {
        return 'short namespaces as much as it can be';
    }
}
