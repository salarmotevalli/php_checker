<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

final class Main extends CommandAbstract
{
    public function main(): void
    {
        \print_r(value: $this->usage() . \PHP_EOL);
    }

    private function usage(): string
    {
        return 'USAGE => /vendor/bin/check <optin> [flag]';
    }

    private function commands(): string
    {
        return 'h';
    }
}
