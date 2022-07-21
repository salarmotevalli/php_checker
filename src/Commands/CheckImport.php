<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\Implementation\AbstractCommand;

final class CheckImport extends AbstractCommand
{
    public function main(): void
    {
        echo 'hello salarrrrrrrrrrrrrrrr' . \PHP_EOL;
    }

    public static function description(): string
    {
        return 'check the class imports';
    }
}
