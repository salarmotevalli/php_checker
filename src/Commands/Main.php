<?php

declare(strict_types=1);

namespace Salarmotevalli\PhpChecker\Commands;

use Salarmotevalli\PhpChecker\Implementation\CommandAbstract;

require_once __DIR__ . '/../CommandRegister.php';

final class Main extends CommandAbstract
{
    public function main(): void
    {
        $this->usage();
        $this->commands();
    }

    public static function description(): string
    {
        return 'check the class imports';
    }

    private function usage(): void
    {
        \print_r(value: 'USAGE => /vendor/bin/check <optin> [flag]' . \PHP_EOL);
        \print_r(value: 'example => /vendor/bin/check check:import --file=app/http/controller/UserControler.php' . \PHP_EOL);
    }

    private function commands(): void
    {
        $commands = commands();
        \print_r('  <option>:' . \PHP_EOL);

        foreach ($commands as $parent => $subs) {
            \print_r(value: "    {$parent}:" . \PHP_EOL);

            foreach ($subs as $sub => $class) {
                \print_r(value: "      {$sub}");
                \print_r("...........{$class::description()}" . \PHP_EOL);
            }
        }
    }
}
