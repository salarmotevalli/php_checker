<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\ImportedClass;
use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

class ShortNamespace extends CommandAbstract
{
    public function main()
    {
        // open
        $file = new ImportedClass('read.php');
        // get namespaces
        $namespaces = $file->allImports();
        // find equal namespace
        if (! $namespaces) {
            echo "\033[31m**/\033[0m there is not any namespace of classes in the file \033[31m/**\033[0m" . PHP_EOL;
            exit;
        }
        $validNamespaces = [];
        foreach ($namespaces as $item) {
            $separated = explode('\\', $item);
            $class = end($separated);
            array_pop($separated);
            $namespace = implode('\\', $separated);
            $validNamespaces[$namespace][] = $class;
        }
        print_r($validNamespaces);
        // change with short form

        // replace in file
        // done
    }

    public static function description(): string
    {
        return 'short namespaces as much as it can be';
    }
}
