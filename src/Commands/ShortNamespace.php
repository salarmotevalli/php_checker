<?php declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\FileWorker\File;
use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

class ShortNamespace extends CommandAbstract
{
    public function main()
    {
        // open
        $file = new File('read.php');
        $namespaces = $file->namespaces();
        // get namespaces
        // find equal namespace
        // change with short form
        // replace in file
        // done
    }

    public static function description(): string
    {
        return 'short namespaces as much as it can be';
    }
}
