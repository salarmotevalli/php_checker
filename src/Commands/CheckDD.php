<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

final class CheckDD extends CommandAbstract
{
    public function main(): void
    {

    }

    public static function description(): string
    {
        return 'find var_dump() and die() method in your project.';
    }
}
